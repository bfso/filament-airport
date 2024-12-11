<?php

namespace App\Domain\Passenger;

use App\Models\Passenger;

class FlightCollisionDetector
{
    public static function run(Passenger $passenger): string
    {
        $flights = $passenger->flights;
        for ($i = 0; $i < $flights->count() - 1; $i++) {
            $currentFlight = $flights[$i];
            $nextFlight = $flights[$i + 1];
            if ($currentFlight->arrival_date > $nextFlight->departure_date) {
                return "Collision!";
            }
        }

        return "";
    }
}
