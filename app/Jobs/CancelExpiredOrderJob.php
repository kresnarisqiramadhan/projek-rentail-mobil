<?php

namespace App\Jobs;

use App\Enums\OrderStatus;
use App\Enums\TransactionActor;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Order;
use App\Notifications\OrderCancelledNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * CancelExpiredOrderJob
 *
 * Automatically cancels PENDING orders that have exceeded the 15-minute payment timeout.
 * Implements FR-C06 (auto-cancel), BRL-07 (no manual intervention needed).
 *
 * IDEMPOTENT: Safe to run multiple times — only cancels if status is still PENDING.
 * ATOMIC: Wrapped in DB transaction — no partial state changes.
 * RELIABLE: 3 retries with 30-second backoff.
 */
class CancelExpiredOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 3;
    public int $backoff = 30; // seconds between retries

    public function __construct(
        private readonly int $orderId
    ) {}

    public function handle(): void
    {
        DB::transaction(function () {
            // Lock the row to prevent race conditions
            $order = Order::lockForUpdate()->find($this->orderId);

            if (!$order) {
                // Order deleted — safe to skip
                Log::warning('CancelExpiredOrderJob: Order not found', ['order_id' => $this->orderId]);
                return;
            }

            // IDEMPOTENT: Only cancel if still PENDING (may have been paid in the meantime)
            if ($order->status !== OrderStatus::PENDING) {
                Log::info('CancelExpiredOrderJob: Skipped — order no longer PENDING', [
                    'order_id' => $this->orderId,
                    'status'   => $order->status->value,
                ]);
                return;
            }

            // Double-check timeout (guard against premature execution edge cases)
            if ($order->payment_timeout_at->isFuture()) {
                Log::warning('CancelExpiredOrderJob: Timer not yet expired, skipping', [
                    'order_id'   => $this->orderId,
                    'timeout_at' => $order->payment_timeout_at,
                ]);
                return;
            }

            // Cancel the order (FR-C06, ER-01)
            $order->update(['status' => OrderStatus::CANCELLED]);

            // Audit log (FR-D05)
            $order->transactions()->create([
                'amount' => $order->total_price,
                'type'   => TransactionType::PAYMENT->value,
                'status' => TransactionStatus::FAILED->value,
                'method' => $order->payment_method->value,
                'actor'  => TransactionActor::SYSTEM->value,
                'notes'  => 'Pesanan dibatalkan otomatis karena batas waktu pembayaran 15 menit habis.',
            ]);

            // Notify customer (FR-E01)
            $order->user->notify(new OrderCancelledNotification($order, 'timeout'));

            Log::info('CancelExpiredOrderJob: Order cancelled', ['order_id' => $this->orderId]);
        });
    }

    /**
     * Handle a job failure — log it for investigation.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('CancelExpiredOrderJob failed', [
            'order_id'  => $this->orderId,
            'exception' => $exception->getMessage(),
        ]);
    }
}
