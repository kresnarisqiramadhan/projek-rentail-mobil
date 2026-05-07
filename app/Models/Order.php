<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'user_id',
        'vehicle_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'payment_method',
        'payment_timeout_at',
        'payment_proof',
        'refund_bank_name',
        'refund_account_name',
        'refund_account_number',
    ];

    protected function casts(): array
    {
        return [
            'start_date'         => 'date',
            'end_date'           => 'date',
            'total_price'        => 'decimal:2',
            'status'             => OrderStatus::class,
            'payment_method'     => PaymentMethod::class,
            'payment_timeout_at' => 'datetime',
        ];
    }

    // ── Relations ──────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function rating(): HasOne
    {
        return $this->hasOne(Rating::class);
    }

    // ── Scopes ────────────────────────────────────────────

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn('status', [
            OrderStatus::PENDING->value,
            OrderStatus::PENDING_VERIFICATION->value,
            OrderStatus::PAID->value,
            OrderStatus::ACTIVE->value,
        ]);
    }

    public function scopeForCustomer(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeHistory(Builder $query): Builder
    {
        return $query->whereIn('status', [
            OrderStatus::COMPLETED->value,
            OrderStatus::RATED->value,
            OrderStatus::CANCELLED->value,
            OrderStatus::REFUND_REQUESTED->value,
            OrderStatus::REFUNDED->value,
        ]);
    }

    public function scopePendingExpired(Builder $query): Builder
    {
        return $query->where('status', OrderStatus::PENDING->value)
                     ->where('payment_timeout_at', '<=', now());
    }

    // ── Helpers ────────────────────────────────────────────

    /**
     * Whether payment is still within the 15-minute window (VR-04)
     */
    public function isPaymentTimerActive(): bool
    {
        return $this->status === OrderStatus::PENDING
            && $this->payment_timeout_at->isFuture();
    }

    /**
     * Rental duration in days (VR-03)
     */
    public function getDurationDaysAttribute(): int
    {
        return $this->start_date->diffInDays($this->end_date);
    }

    /**
     * Whether customer can cancel this order (FR-C02)
     */
    public function canBeCancelledByCustomer(): bool
    {
        return in_array($this->status, [OrderStatus::PENDING, OrderStatus::PAID])
            && $this->start_date->isFuture();
    }

    /**
     * Whether customer can modify dates (FR-C03)
     */
    public function canModifyDates(): bool
    {
        return in_array($this->status, [OrderStatus::PENDING, OrderStatus::PAID])
            && $this->start_date->isFuture();
    }

    /**
     * Whether refund can be requested (VR-05)
     */
    public function canRequestRefund(): bool
    {
        // Must be CANCELLED, must have had a PAID transaction, must be before start date
        if ($this->status !== OrderStatus::CANCELLED) {
            return false;
        }
        if ($this->start_date->isPast()) {
            return false;
        }
        return $this->transactions()
            ->where('type', 'PAYMENT')
            ->where('status', 'SUCCESS')
            ->exists();
    }

    /**
     * Generate readable order code: ORD-YYYYMMDD-XXXX
     */
    public static function generateOrderCode(): string
    {
        $date   = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        return "ORD-{$date}-{$random}";
    }
}
