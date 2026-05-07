<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'role'              => UserRole::class,
            'is_active'         => 'boolean',
        ];
    }

    // ── Relations ──────────────────────────────────────────

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    // ── Helpers ────────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    public function isCustomer(): bool
    {
        return $this->role === UserRole::CUSTOMER;
    }

    public function isActive(): bool
    {
        return $this->is_active === true;
    }

    public function routeNotificationForMail(): string
    {
        return $this->email;
    }
}
