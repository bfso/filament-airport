<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $passengerEmails = DB::query()
        ->select('email')
        ->from('passengers')
        ->get();

    $flights = DB::table('flights')
        ->join('passenger_flight', 'passenger_flight.flight_id', '=', 'flights.id')
        ->select('flights.id', 'flights.number', DB::raw('COUNT(passenger_flight.id) as passenger_count'))
        ->groupBy('flights.id', 'flights.number')
        ->get();
    dd($flights);

    return view('welcome');
});
