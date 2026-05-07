<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => Hash::make('Password123'),
            'role'              => UserRole::CUSTOMER,
            'is_active'         => true,
            'profile_photo'     => null,
            'remember_token'    => \Str::random(10),
        ];
    }

    public function admin(): static
    {
        return $this->state([
            'role'  => UserRole::ADMIN,
            'email' => 'admin@rental.test',
            'name'  => 'Admin Rental',
        ]);
    }

    public function customer(): static
    {
        return $this->state([
            'role'  => UserRole::CUSTOMER,
            'email' => 'customer@rental.test',
            'name'  => 'Budi Santoso',
        ]);
    }

    public function inactive(): static
    {
        return $this->state([
            'is_active' => false,
            'email'     => 'inactive@rental.test',
        ]);
    }

    public function withPassword(string $password): static
    {
        return $this->state([
            'password' => Hash::make($password),
        ]);
    }
}
