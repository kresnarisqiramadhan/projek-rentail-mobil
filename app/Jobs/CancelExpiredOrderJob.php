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

class CancelExpiredOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 30;

    public function __construct(
        private readonly int $orderId
    ) {}

    public function handle(): void
    {
        DB::transaction(function () {
            $order = Order::lockForUpdate()->find($this->orderId);

            if (!$order) {
                Log::warning('CancelExpiredOrderJob: Order not found', ['order_id' => $this->orderId]);
                return;
            }

            if ($order->status !== OrderStatus::PENDING) {
                Log::info('CancelExpiredOrderJob: Skipped — order no longer PENDING', [
                    'order_id' => $this->orderId,
                    'status'   => $order->status->value,
                ]);
                return;
            }

            if ($order->payment_timeout_at->isFuture()) {
                Log::warning('CancelExpiredOrderJob: Timer not yet expired, skipping', [
                    'order_id'   => $this->orderId,
                    'timeout_at' => $order->payment_timeout_at,
                ]);
                return;
            }

            $order->update(['status' => OrderStatus::CANCELLED]);

            $order->transactions()->create([
                'amount' => $order->total_price,
                'type'   => TransactionType::PAYMENT->value,
                'status' => TransactionStatus::FAILED->value,
                'method' => $order->payment_method->value,
                'actor'  => TransactionActor::SYSTEM->value,
                'notes'  => 'Pesanan dibatalkan otomatis karena batas waktu pembayaran 15 menit habis.',
            ]);

            $order->user->notify(new OrderCancelledNotification($order, 'timeout'));

            Log::info('CancelExpiredOrderJob: Order cancelled', ['order_id' => $this->orderId]);
        });
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('CancelExpiredOrderJob failed', [
            'order_id'  => $this->orderId,
            'exception' => $exception->getMessage(),
        ]);
    }
}
