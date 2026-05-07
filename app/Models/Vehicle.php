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
        'type',
        'plate_number',
        'price_per_day',
        'condition',
        'avg_rating',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price_per_day' => 'decimal:2',
            'avg_rating'    => 'decimal:2',
            'is_active'     => 'boolean',
        ];
    }

    // ── Relations ──────────────────────────────────────────

    public function photos(): HasMany
    {
        return $this->hasMany(VehiclePhoto::class)->orderBy('sort_order');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    // ── Scopes ────────────────────────────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFilterByType(Builder $query, ?string $type): Builder
    {
        return $type ? $query->where('type', $type) : $query;
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

    // ── Helpers ────────────────────────────────────────────

    /**
     * Check if vehicle has any active booking in the given date range.
     * Used for availability check (VR-02).
     */
    public function hasActiveBookingInRange(\Carbon\Carbon $startDate, \Carbon\Carbon $endDate, ?int $excludeOrderId = null): bool
    {
        return $this->orders()
            ->whereIn('status', array_map(
                fn($s) => $s->value,
                OrderStatus::blockingDeletion()
            ))
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_date', '<', $endDate)
                      ->where('end_date', '>', $startDate);
            })
            ->when($excludeOrderId, fn($q) => $q->where('id', '!=', $excludeOrderId))
            ->exists();
    }

    /**
     * Whether this vehicle can be deleted (VR-08)
     */
    public function canBeDeleted(): bool
    {
        return !$this->orders()
            ->whereIn('status', array_map(
                fn($s) => $s->value,
                OrderStatus::blockingDeletion()
            ))
            ->exists();
    }

    /**
     * Recalculate and save avg_rating from ratings table
     */
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
