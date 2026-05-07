<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Rating;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition(): array
    {
        $order = Order::factory()->completed()->create();

        return [
            'order_id'   => $order->id,
            'user_id'    => $order->user_id,
            'vehicle_id' => $order->vehicle_id,
            'score'      => fake()->numberBetween(1, 5),
            'comment'    => fake()->optional(0.7)->sentence(),
        ];
    }

    public function forOrder(Order $order): static
    {
        return $this->state([
            'order_id'   => $order->id,
            'user_id'    => $order->user_id,
            'vehicle_id' => $order->vehicle_id,
        ]);
    }

    public function withScore(int $score): static
    {
        return $this->state(['score' => $score]);
    }

    public function withComment(string $comment): static
    {
        return $this->state(['comment' => $comment]);
    }
}
