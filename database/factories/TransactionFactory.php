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
        return [
            'order_id'    => Order::factory(),
            'amount'      => 0,
            'type'        => TransactionType::PAYMENT,
            'status'      => TransactionStatus::SUCCESS,
            'method'      => PaymentMethod::BANK->value,
            'gateway_ref' => 'GW-' . strtoupper(fake()->bothify('??########')),
            'actor'       => TransactionActor::CUSTOMER,
            'notes'       => null,
        ];
    }

    public function paymentSuccess(): static
    {
        return $this->state([
            'type'   => TransactionType::PAYMENT,
            'status' => TransactionStatus::SUCCESS,
            'actor'  => TransactionActor::CUSTOMER,
        ]);
    }

    public function paymentFailed(): static
    {
        return $this->state([
            'type'   => TransactionType::PAYMENT,
            'status' => TransactionStatus::FAILED,
            'actor'  => TransactionActor::CUSTOMER,
        ]);
    }

    public function manualPaymentPending(): static
    {
        return $this->state([
            'type'        => TransactionType::PAYMENT,
            'status'      => TransactionStatus::PENDING,
            'method'      => PaymentMethod::BANK->value,
            'actor'       => TransactionActor::CUSTOMER,
            'gateway_ref' => null,
        ]);
    }

    public function adminVerified(): static
    {
        return $this->state([
            'type'   => TransactionType::PAYMENT,
            'status' => TransactionStatus::SUCCESS,
            'method' => PaymentMethod::BANK->value,
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
