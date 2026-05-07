<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehiclePhoto extends Model
{
    protected $fillable = [
        'vehicle_id',
        'path',
        'is_360',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_360'     => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }
}
