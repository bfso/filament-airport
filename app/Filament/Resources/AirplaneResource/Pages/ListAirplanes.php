<?php

namespace App\Filament\Resources\AirplaneResource\Pages;

use App\Filament\Resources\AirplaneResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAirplanes extends ListRecords
{
    protected static string $resource = AirplaneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
