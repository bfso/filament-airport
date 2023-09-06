<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Filament\Resources\FlightResource\RelationManagers;
use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Flight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlightResource extends Resource
{
    protected static ?string $model = Flight::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->default(function(){return rand(1000,9999);}),
                Forms\Components\Select::make('airplane_id')
                    ->relationship('airplane', 'typ')
                    ->default(function(){return Airplane::inRandomOrder()->first()->id;}),
                Forms\Components\Select::make('start_airport_id')
                    ->relationship('start', 'short_name')
                    ->default(function(){return Airport::inRandomOrder()->first()->id;}),
                Forms\Components\Select::make('end_airport_id')
                    ->relationship('end', 'short_name')
                    ->default(function(){return Airport::inRandomOrder()->first()->id;}),
                Forms\Components\DatePicker::make('departure_date')
                    ->required()
                    ->default(function(){return now();}),
                Forms\Components\DatePicker::make('arrival_date')
                    ->required()
                    ->default(function(){return now();}),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number'),
                Tables\Columns\TextColumn::make('airplane.typ'),
                Tables\Columns\TextColumn::make('start.short_name'),
                Tables\Columns\TextColumn::make('end.short_name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PassengersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFlights::route('/'),
            'create' => Pages\CreateFlight::route('/create'),
            'edit' => Pages\EditFlight::route('/{record}/edit'),
        ];
    }
}
