<?php

namespace App\Filament\Resources\PassengerFlightResource\Pages;

use App\Filament\Resources\PassengerFlightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPassengerFlights extends ListRecords
{
    protected static string $resource = PassengerFlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
