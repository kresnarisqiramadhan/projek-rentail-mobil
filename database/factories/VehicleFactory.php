<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    private static array $types = ['MPV', 'SUV', 'Sedan', 'Hatchback', 'Pickup'];

    private static array $brands = [
        'Toyota Avanza', 'Toyota Innova', 'Honda Jazz', 'Honda CRV',
        'Mitsubishi Xpander', 'Daihatsu Xenia', 'Suzuki Ertiga',
        'Nissan Livina', 'Mazda CX-5', 'Ford Ranger',
    ];

    public function definition(): array
    {
        return [
            'name'          => fake()->randomElement(self::$brands) . ' ' . fake()->year(),
            'type'          => fake()->randomElement(self::$types),
            'plate_number'  => 'B ' . fake()->unique()->numerify('####') . ' ' . strtoupper(fake()->lexify('???')),
            'price_per_day' => fake()->randomElement([200000, 250000, 300000, 350000, 400000, 500000]),
            'condition'     => fake()->sentence(10),
            'avg_rating'    => 0.00,
            'is_active'     => true,
        ];
    }

    public function available(): static
    {
        return $this->state(['is_active' => true]);
    }

    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }

    public function withPrice(float $price): static
    {
        return $this->state(['price_per_day' => $price]);
    }

    public function withType(string $type): static
    {
        return $this->state(['type' => $type]);
    }
}
