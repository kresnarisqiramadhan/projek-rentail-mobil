<?php

namespace LuxeDrive\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'class',
        'price_per_day',
        'acceleration',
        'seats',
        'luggage',
        'image_url',
        'image_alt',
        'electric'
    ];
}
