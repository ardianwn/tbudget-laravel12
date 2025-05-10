<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tourism_id', 'content', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tourism()
    {
        return $this->belongsTo(Tourism::class);
    }
}
