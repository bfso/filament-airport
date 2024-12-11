<?php

use App\Models\Flight;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $passengerEmails = DB::query()
        ->select('email')
        ->from('passengers')
        ->get();



    $flights = Flight::withCount('passengers')
        ->with('passengers')
        ->having('passengers_count', '<', 1)
        ->get();

    $flights = Flight::get();

    foreach ($flights as $flight) {
        $flight->passengers;
    }

    dd($flights);


    // return view('welcome');
});
