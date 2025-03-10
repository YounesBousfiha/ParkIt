<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'parking_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function parking() {
        return $this->belongsTo(Parking::class);
    }
}
