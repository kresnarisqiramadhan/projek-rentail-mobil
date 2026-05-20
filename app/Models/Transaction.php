<?php

namespace App\Models;

use App\Enums\TransactionActor;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    public $timestamps = false;
    const CREATED_AT = 'created_at';

    protected $fillable = [
        'order_id',
        'amount',
        'type',
        'status',
        'method',
        'gateway_ref',
        'actor',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount'      => 'decimal:2',
            'type'        => TransactionType::class,
            'status'      => TransactionStatus::class,
            'actor'       => TransactionActor::class,
            'created_at'  => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::updating(function () {
            throw new \LogicException('Transaction records are immutable and cannot be updated.');
        });

        static::deleting(function () {
            throw new \LogicException('Transaction records are immutable and cannot be deleted.');
        });
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
