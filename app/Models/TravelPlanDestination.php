<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelPlanDestination extends Model
{
    protected $fillable = [
        'travel_plan_id',
        'tourism_id',
        'order'
    ];

    public function travelPlan()
    {
        return $this->belongsTo(TravelPlan::class);
    }

    public function tourism()
    {
        return $this->belongsTo(Tourism::class);
    }
} 