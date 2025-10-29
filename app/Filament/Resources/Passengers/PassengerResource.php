<?php

namespace App\Filament\Resources\Passengers;

use App\Filament\Resources\Passengers\Schemas\PassengerForm;
use App\Filament\Resources\Passengers\Tables\PassengersTable;
use App\Models\Passenger;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PassengerResource extends Resource
{
    protected static ?string $model = Passenger::class;

    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return PassengerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PassengersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FlightsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPassengers::route('/'),
            'create' => Pages\CreatePassenger::route('/create'),
            'edit' => Pages\EditPassenger::route('/{record}/edit'),
        ];
    }
}
