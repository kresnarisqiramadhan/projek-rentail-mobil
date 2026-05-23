<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'model',
        'year',
        'type',
        'plate_number',
        'price_per_day',
        'condition',
        'seats',
        'avg_rating',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price_per_day' => 'decimal:2',
            'avg_rating'    => 'decimal:2',
            'is_active'     => 'boolean',
            'seats'         => 'integer',
        ];
    }

    public function photos(): HasMany
    {
        return $this->hasMany(VehiclePhoto::class)->orderBy('sort_order');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function favoritedBy(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function isFavoritedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFilterByBrand(Builder $query, ?array $brands): Builder
    {
        return $brands ? $query->whereIn('brand', $brands) : $query;
    }

    public function scopeFilterBySeats(Builder $query, ?array $seats): Builder
    {
        return $seats ? $query->whereIn('seats', $seats) : $query;
    }

    public function scopeFilterByPriceRange(Builder $query, ?float $min, ?float $max): Builder
    {
        if ($min !== null) {
            $query->where('price_per_day', '>=', $min);
        }
        if ($max !== null) {
            $query->where('price_per_day', '<=', $max);
        }
        return $query;
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->whereDoesntHave('orders', function ($q) {
            $q->whereIn('status', array_map(fn($s) => $s->value, OrderStatus::blockingDeletion()));
        });
    }

    public function hasActiveBookingInRange(\Carbon\Carbon $startDate, \Carbon\Carbon $endDate, ?int $excludeOrderId = null): bool
    {
        return $this->orders()
            ->whereIn('status', array_map(fn($s) => $s->value, OrderStatus::blockingDeletion()))
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_date', '<', $endDate)
                      ->where('end_date', '>', $startDate);
            })
            ->when($excludeOrderId, fn($q) => $q->where('id', '!=', $excludeOrderId))
            ->exists();
    }

    public function canBeDeleted(): bool
    {
        return !$this->orders()
            ->whereIn('status', array_map(fn($s) => $s->value, OrderStatus::blockingDeletion()))
            ->exists();
    }

    public function recalculateAvgRating(): void
    {
        $avg = $this->ratings()->avg('score') ?? 0;
        $this->update(['avg_rating' => round($avg, 2)]);
    }

    public function getThumbnailAttribute(): ?string
    {
        return $this->photos->first()?->path;
    }
}
