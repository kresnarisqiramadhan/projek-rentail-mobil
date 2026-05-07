<?php

namespace Database\Factories;

use App\Enums\PaymentMethod;
use App\Enums\TransactionActor;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        $order = Order::factory()->create();

        return [
            'order_id'    => $order->id,
            'amount'      => $order->total_price,
            'type'        => TransactionType::PAYMENT,
            'status'      => TransactionStatus::SUCCESS,
            'method'      => PaymentMethod::GATEWAY->value,
            'gateway_ref' => 'GW-' . strtoupper(fake()->bothify('??########')),
            'actor'       => TransactionActor::GATEWAY,
            'notes'       => null,
        ];
    }

    public function paymentSuccess(): static
    {
        return $this->state([
            'type'   => TransactionType::PAYMENT,
            'status' => TransactionStatus::SUCCESS,
            'actor'  => TransactionActor::GATEWAY,
        ]);
    }

    public function paymentFailed(): static
    {
        return $this->state([
            'type'   => TransactionType::PAYMENT,
            'status' => TransactionStatus::FAILED,
            'actor'  => TransactionActor::GATEWAY,
        ]);
    }

    public function manualPaymentPending(): static
    {
        return $this->state([
            'type'        => TransactionType::PAYMENT,
            'status'      => TransactionStatus::PENDING,
            'method'      => PaymentMethod::MANUAL->value,
            'actor'       => TransactionActor::CUSTOMER,
            'gateway_ref' => null,
        ]);
    }

    public function adminVerified(): static
    {
        return $this->state([
            'type'   => TransactionType::PAYMENT,
            'status' => TransactionStatus::SUCCESS,
            'method' => PaymentMethod::MANUAL->value,
            'actor'  => TransactionActor::ADMIN,
        ]);
    }

    public function refund(): static
    {
        return $this->state([
            'type'   => TransactionType::REFUND,
            'status' => TransactionStatus::SUCCESS,
            'actor'  => TransactionActor::ADMIN,
        ]);
    }
}
