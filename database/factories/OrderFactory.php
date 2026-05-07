<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\Order;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $startDate  = fake()->dateTimeBetween('+1 days', '+30 days');
        $endDate    = fake()->dateTimeBetween($startDate, '+60 days');
        $vehicle    = Vehicle::factory()->create();
        $days       = max(1, \Carbon\Carbon::parse($startDate)->diffInDays(\Carbon\Carbon::parse($endDate)));
        $totalPrice = $vehicle->price_per_day * $days;

        return [
            'order_code'         => Order::generateOrderCode(),
            'user_id'            => User::factory(),
            'vehicle_id'         => $vehicle->id,
            'start_date'         => $startDate,
            'end_date'           => $endDate,
            'total_price'        => $totalPrice,
            'status'             => OrderStatus::PENDING,
            'payment_method'     => fake()->randomElement([PaymentMethod::GATEWAY->value, PaymentMethod::MANUAL->value]),
            'payment_timeout_at' => now()->addMinutes(15),
            'payment_proof'      => null,
        ];
    }

    // ── State shortcuts for test scenarios (STD) ──────────

    public function pending(): static
    {
        return $this->state([
            'status'             => OrderStatus::PENDING,
            'payment_timeout_at' => now()->addMinutes(15),
        ]);
    }

    public function pendingVerification(): static
    {
        return $this->state([
            'status'        => OrderStatus::PENDING_VERIFICATION,
            'payment_proof' => 'payment_proofs/test-proof.jpg',
        ]);
    }

    public function paid(): static
    {
        return $this->state(['status' => OrderStatus::PAID]);
    }

    public function active(): static
    {
        return $this->state([
            'status'     => OrderStatus::ACTIVE,
            'start_date' => now()->subDays(1),
            'end_date'   => now()->addDays(2),
        ]);
    }

    public function completed(): static
    {
        return $this->state([
            'status'     => OrderStatus::COMPLETED,
            'start_date' => now()->subDays(5),
            'end_date'   => now()->subDays(1),
        ]);
    }

    public function rated(): static
    {
        return $this->state(['status' => OrderStatus::RATED]);
    }

    public function cancelled(): static
    {
        return $this->state(['status' => OrderStatus::CANCELLED]);
    }

    public function refundRequested(): static
    {
        return $this->state([
            'status'                => OrderStatus::REFUND_REQUESTED,
            'refund_bank_name'      => 'BCA',
            'refund_account_name'   => 'Budi Santoso',
            'refund_account_number' => '1234567890',
        ]);
    }

    public function refunded(): static
    {
        return $this->state(['status' => OrderStatus::REFUNDED]);
    }

    /**
     * Expired — timer has passed, still PENDING (triggers auto-cancel)
     */
    public function expired(): static
    {
        return $this->state([
            'status'             => OrderStatus::PENDING,
            'payment_timeout_at' => now()->subMinutes(16),
        ]);
    }

    public function forCustomer(User $user): static
    {
        return $this->state(['user_id' => $user->id]);
    }

    public function forVehicle(Vehicle $vehicle): static
    {
        return $this->state([
            'vehicle_id'  => $vehicle->id,
            'total_price' => $vehicle->price_per_day * 2,
        ]);
    }

    public function withManualPayment(): static
    {
        return $this->state(['payment_method' => PaymentMethod::MANUAL->value]);
    }

    public function withGatewayPayment(): static
    {
        return $this->state(['payment_method' => PaymentMethod::GATEWAY->value]);
    }
}
