<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\TransactionActor;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Order;
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

    public function adminRejectPayment(Order $order, string $reason): void
    {
        if ($order->status !== OrderStatus::PENDING_VERIFICATION) {
            throw new \RuntimeException('Pesanan tidak dalam status menunggu verifikasi.');
        }

        DB::transaction(function () use ($order, $reason) {
            $this->stateMachine->assertCanTransition($order->status, OrderStatus::PENDING);

            $order->update([
                'status'        => OrderStatus::PENDING,
                'payment_proof' => null,
            ]);

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

    public function processRefund(Order $order): void
    {
        if ($order->status !== OrderStatus::REFUND_REQUESTED) {
            throw new \RuntimeException('Pesanan tidak dalam status pengajuan refund.');
        }

        DB::transaction(function () use ($order) {
            $this->stateMachine->assertCanTransition($order->status, OrderStatus::REFUNDED);

            $order->update(['status' => OrderStatus::REFUNDED]);

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

    public function validateGatewaySignature(string $payload, string $receivedSignature): bool
    {
        $secret   = config('services.payment_gateway.webhook_secret');
        $expected = hash_hmac('sha256', $payload, $secret);
        return hash_equals($expected, $receivedSignature);
    }

    private function confirmPayment(Order $order, ?string $gatewayRef, TransactionActor $actor): void
    {
        if ($order->status === OrderStatus::PAID) {
            Log::warning('Duplicate payment callback ignored', ['order_id' => $order->id]);
            return;
        }

        $this->stateMachine->assertCanTransition($order->status, OrderStatus::PAID);

        $order->update(['status' => OrderStatus::PAID]);

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
}
