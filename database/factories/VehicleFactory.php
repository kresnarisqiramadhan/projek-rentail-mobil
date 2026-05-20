<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    private static array $brands = [
        'Toyota' => ['Avanza', 'Innova', 'Fortuner', 'Rush', 'Agya'],
        'Daihatsu' => ['Xenia', 'Terios', 'Ayla', 'Rocky'],
        'Honda' => ['CR-V', 'BR-V', 'Mobilio', 'City'],
        'Mitsubishi' => ['Xpander', 'Pajero Sport'],
        'Suzuki' => ['Ertiga', 'XL7', 'Baleno'],
        'Wuling' => ['Confero', 'Almaz', 'Cortez'],
        'Hyundai' => ['Stargazer', 'Creta', 'Palisade'],
        'Nissan' => ['Livina', 'X-Trail', 'March'],
    ];

    public function definition(): array
    {
        $brand = fake()->randomElement(array_keys(self::$brands));
        $model = fake()->randomElement(self::$brands[$brand]);
        $year  = fake()->year();

        return [
            'name'          => $brand . ' ' . $model . ' ' . $year,
            'brand'         => $brand,
            'model'         => $model,
            'year'         => $year,
            'type'          => fake()->randomElement(['MPV', 'SUV', 'Sedan', 'Hatchback', 'Pickup']),
            'plate_number'  => 'B ' . fake()->unique()->numerify('####') . ' ' . strtoupper(fake()->lexify('???')),
            'price_per_day' => fake()->randomElement([200000, 250000, 300000, 350000, 400000, 500000]),
            'condition'     => fake()->sentence(10),
            'seats'         => fake()->randomElement([5, 7, 8]),
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
