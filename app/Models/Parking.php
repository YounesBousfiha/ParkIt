<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'total_places',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reservation() {
        return $this->hasMany(Reservations::class);
    }
}
