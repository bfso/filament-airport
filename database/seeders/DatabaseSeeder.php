<?php

namespace Database\Seeders;

use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Passenger;
use App\Models\PassengerFlight;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\SessionGuard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** @var SessionGuard $auth */
        $auth = Filament::auth();

        /** @var EloquentUserProvider $userProvider */
        $userProvider = $auth->getProvider();

        $userModel = $userProvider->getModel();

        $user = $userModel::create([
            'email'=>'admin@bfo.ch',
            'name'=>'admin@bfo.ch',
            'password'=>Hash::make('admin@bfo.ch'),
        ]);

        $plane747 = Airplane::create([
            'typ'=>'747',
        ]);

        $planeA380 = Airplane::create([
            'typ'=>'A380',
        ]);

        $airportZrh = Airport::create([
            'short_name'=>'ZRH',
            'name'=>'Zürich',
        ]);

        $airportLax = Airport::create([
            'short_name'=>'LAX',
            'name'=>'Los Angeles',
        ]);

        $airportJfk = Airport::create([
            'short_name'=>'JFK',
            'name'=>'New York',
        ]);

        $flight1 = Flight::create([
            'number'=>255686,
            'departure_date'=>now(),
            'arrival_date'=>now(),
            'airplane_id'=>$plane747->id,
            'start_airport_id'=>$airportZrh->id,
            'end_airport_id'=>$airportLax->id,
        ]);

        $flight2 = Flight::create([
            'number'=>13586,
            'departure_date'=>now(),
            'arrival_date'=>now(),
            'airplane_id'=>$planeA380->id,
            'start_airport_id'=>$airportZrh->id,
            'end_airport_id'=>$airportJfk->id,
        ]);

        $flight3 = Flight::create([
            'number'=>988856,
            'departure_date'=>now(),
            'arrival_date'=>now(),
            'airplane_id'=>$planeA380->id,
            'start_airport_id'=>$airportJfk->id,
            'end_airport_id'=>$airportZrh->id,
        ]);

        $passenger1 = Passenger::create([
            'email' => 'test1@bfo.ch'
        ]);

        $passenger2 = Passenger::create([
            'email' => 'test2@bfo.ch'
        ]);

        $passenger3 = Passenger::create([
            'email' => 'test3@bfo.ch'
        ]);

        PassengerFlight::create([
            'flight_id' => $flight1->id,
            'passenger_id' => $passenger1->id
        ]);

        PassengerFlight::create([
            'flight_id' => $flight2->id,
            'passenger_id' => $passenger1->id
        ]);

        PassengerFlight::create([
            'flight_id' => $flight2->id,
            'passenger_id' => $passenger2->id
        ]);
    }
}
