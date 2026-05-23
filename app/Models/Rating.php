<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'vehicle_id',
        'score',
        'comment',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(RatingVote::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(RatingVote::class)->where('type', 'like');
    }

    public function dislikes(): HasMany
    {
        return $this->hasMany(RatingVote::class)->where('type', 'dislike');
    }

    public function getUserVote(?User $user): ?string
    {
        if (!$user) return null;
        return $this->votes()->where('user_id', $user->id)->value('type');
    }

    protected static function booted(): void
    {
        static::deleted(function (Rating $rating) {
            $rating->vehicle->recalculateAvgRating();
        });
    }
}
