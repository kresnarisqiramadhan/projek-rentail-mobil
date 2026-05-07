<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\TransactionActor;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderStatusChangedNotification;
use App\Notifications\PaymentConfirmedNotification;
use App\Notifications\PaymentRejectedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function __construct(
        private readonly OrderStateMachine $stateMachine
    ) {}

    // ──────────────────────────────────────────────────────────────────────────
    // FR-D01: Handle Payment Gateway Callback (webhook)
    // API-01: HMAC signature already validated by middleware before reaching here
    // ──────────────────────────────────────────────────────────────────────────
    public function handleGatewayCallback(array $payload): void
    {
        DB::transaction(function () use ($payload) {
            $order = Order::lockForUpdate()
                ->where('order_code', $payload['order_id'])
                ->firstOrFail();

            $isSuccess  = $payload['status'] === 'success';
            $gatewayRef = $payload['gateway_ref'] ?? null;

            if ($isSuccess) {
                $this->confirmPayment($order, $gatewayRef, TransactionActor::GATEWAY);
            } else {
                $this->recordFailedPayment($order, $gatewayRef, $payload['notes'] ?? 'Gateway reported failure.');
            }
        });
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-D04: Admin Verify Manual Payment (approve)
    // ──────────────────────────────────────────────────────────────────────────
    public function adminApprovePayment(Order $order): void
    {
        if ($order->status !== OrderStatus::PENDING_VERIFICATION) {
            throw new \RuntimeException('Pesanan tidak dalam status menunggu verifikasi.');
        }

        DB::transaction(function () use ($order) {
            $this->stateMachine->assertCanTransition($order->status, OrderStatus::PAID);
            $this->confirmPayment($order, null, TransactionActor::ADMIN);
        });
    }

    // ──────────────────────────────────────────────────────────────────────────
    // FR-D04: Admin Reject Manual Payment
    // Status returns to PENDING so customer can re-upload (SRS §3.9)
    // ──────────────────────────────────────────────────────────────────────────
    public function adminRejectPayment(Order $order, string $reason): void
    {
        if ($order->status !== OrderStatus::PENDING_VERIFICATION) {
            throw new \RuntimeException('Pesanan tidak dalam status menunggu verifikasi.');
        }

        DB::transaction(function () use ($order, $reason) {
            // PENDING_VERIFICATION → PENDING (admin rejects, customer can re-upload)
            $this->stateMachine->assertCanTransition($order->status, OrderStatus::PENDING);

            $order->update([
                'status'        => OrderStatus::PENDING,
                'payment_proof' => null, // clear old proof
            ]);

            // Audit log
            $order->transactions()->create([
                'amount' => $order->total_price,
                'type'   => TransactionType::PAYMENT->value,
                'status' => TransactionStatus::FAILED->value,
                'method' => $order->payment_method->value,
                'actor'  => TransactionActor::ADMIN->value,
                'notes'  => "Bukti pembayaran ditolak: {$reason}",
            ]);

            $order->user->notify(new PaymentRejectedNotification($order, $reason));

            Log::info('Manual payment rejected by admin', ['order_id' => $order->id, 'reason' => $reason]);
        });
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Admin: Process Refund (REFUND_REQUESTED → REFUNDED)
    // ──────────────────────────────────────────────────────────────────────────
    public function processRefund(Order $order, User $admin): void
    {
        if ($order->status !== OrderStatus::REFUND_REQUESTED) {
            throw new \RuntimeException('Pesanan tidak dalam status pengajuan refund.');
        }

        DB::transaction(function () use ($order) {
            $this->stateMachine->assertCanTransition($order->status, OrderStatus::REFUNDED);

            $order->update(['status' => OrderStatus::REFUNDED]);

            // Audit log — refund transaction
            $order->transactions()->create([
                'amount' => $order->total_price,
                'type'   => TransactionType::REFUND->value,
                'status' => TransactionStatus::SUCCESS->value,
                'method' => $order->payment_method->value,
                'actor'  => TransactionActor::ADMIN->value,
                'notes'  => 'Refund diproses oleh admin.',
            ]);

            $order->user->notify(new OrderStatusChangedNotification($order, 'Refund Anda telah diproses.'));

            Log::info('Refund processed', ['order_id' => $order->id]);
        });
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Private: Shared logic for confirming payment (gateway OR admin manual)
    // ──────────────────────────────────────────────────────────────────────────
    private function confirmPayment(Order $order, ?string $gatewayRef, TransactionActor $actor): void
    {
        // Idempotency: if already PAID, skip (handles duplicate callbacks)
        if ($order->status === OrderStatus::PAID) {
            Log::warning('Duplicate payment callback ignored', ['order_id' => $order->id]);
            return;
        }

        $this->stateMachine->assertCanTransition($order->status, OrderStatus::PAID);

        $order->update(['status' => OrderStatus::PAID]);

        // Immutable audit log (FR-D05)
        $order->transactions()->create([
            'amount'      => $order->total_price,
            'type'        => TransactionType::PAYMENT->value,
            'status'      => TransactionStatus::SUCCESS->value,
            'method'      => $order->payment_method->value,
            'gateway_ref' => $gatewayRef,
            'actor'       => $actor->value,
            'notes'       => 'Pembayaran dikonfirmasi.',
        ]);

        $order->user->notify(new PaymentConfirmedNotification($order));

        Log::info('Payment confirmed', [
            'order_id'   => $order->id,
            'actor'      => $actor->value,
            'gateway_ref' => $gatewayRef,
        ]);
    }

    private function recordFailedPayment(Order $order, ?string $gatewayRef, string $reason): void
    {
        // Status stays PENDING — customer can retry (FR-D03)
        $order->transactions()->create([
            'amount'      => $order->total_price,
            'type'        => TransactionType::PAYMENT->value,
            'status'      => TransactionStatus::FAILED->value,
            'method'      => $order->payment_method->value,
            'gateway_ref' => $gatewayRef,
            'actor'       => TransactionActor::GATEWAY->value,
            'notes'       => $reason,
        ]);

        Log::warning('Payment failed', ['order_id' => $order->id, 'reason' => $reason]);
    }

    // ──────────────────────────────────────────────────────────────────────────
    // Validate HMAC-SHA256 signature from payment gateway (API-01)
    // ──────────────────────────────────────────────────────────────────────────
    public function validateGatewaySignature(string $payload, string $receivedSignature): bool
    {
        $secret   = config('services.payment_gateway.webhook_secret');
        $expected = hash_hmac('sha256', $payload, $secret);
        return hash_equals($expected, $receivedSignature);
    }
}
