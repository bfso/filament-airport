<?php

namespace App\Filament\Resources\Passengers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class PassengerForm
{
    public static function configure(Schema $schema)
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
