<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PassengerFlight extends Pivot
{
    use HasFactory;

    public $table = 'passenger_flight';

    public $fillable = [
        'passenger_id',
        'flight_id',
    ];

    public function passenger(){
        return $this->belongsTo(Passenger::class);
    }

    public function flight(){
        return $this->belongsTo(Flight::class);
    }
}
