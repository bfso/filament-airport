<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PassengerResource\Pages;
use App\Filament\Resources\PassengerResource\RelationManagers;
use App\Models\Passenger;
use App\Models\PassengerField;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PassengerResource extends Resource
{
    protected static ?string $model = Passenger::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        $fields[] = Forms\Components\TextInput::make('email')->required();

        return $form
            ->schema(
                $fields
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
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
