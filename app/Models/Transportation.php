<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_name',
        'type',
        'price',
        'duration_minutes',
        'departure_times',
        'coordinates'
    ];

    protected $casts = [
        'departure_times' => 'array',
        'coordinates' => 'array'
    ];
} 