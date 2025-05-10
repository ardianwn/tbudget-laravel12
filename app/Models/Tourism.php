<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourism extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'location',
        'description',
        'latitude',
        'longitude',
        'entrance_fee',
        'facilities',
        'image',
        'address',
        'opening_hours',
        'rating'
    ];

    protected $casts = [
        'facilities' => 'array',
        'latitude' => 'float',
        'longitude' => 'float',
        'rating' => 'float',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    public function travelPlanDestinations()
    {
        return $this->hasMany(TravelPlanDestination::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class)->orderBy('order');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
