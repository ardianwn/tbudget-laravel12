<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalRoute extends Model
{
    protected $fillable = [
        'name',
        'type',
        'price',
        'frequency',
        'coordinates'
    ];

    protected $casts = [
        'coordinates' => 'array'
    ];
} 