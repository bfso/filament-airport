<?php

namespace App\Filament\Resources\Flights\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class FlightForm
{
    public static function configure(Schema $schema)
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('departure_date')
                    ->required(),
                Forms\Components\DateTimePicker::make('arrival_date')
                    ->required(),
                Forms\Components\Select::make('airplane_id')
                    ->relationship('airplane', 'typ')
                    ->required(),
                Forms\Components\Select::make('start_airport_id')
                    ->required()
                    ->relationship('start', 'short_name'),
                Forms\Components\Select::make('end_airport_id')
                    ->required()
                    ->relationship('end', 'short_name'),
            ]);

    }
}
