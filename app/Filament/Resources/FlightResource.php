<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Models\Flight;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class FlightResource extends Resource
{
    protected static ?string $model = Flight::class;

    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),

                Tables\Columns\TextColumn::make('start.short_name')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end.short_name')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('departure_date')
                    ->formatStateUsing(function ($state){
                        return $state->format('d. M. Y');
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('arrival_date')
                    ->formatStateUsing(function ($state){
                        return $state->format('d. M. Y');
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('airplane.typ')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('passengers_count'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->modifyQueryUsing(function ($query){
                return $query->withCount('passengers');
            })
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListFlights::route('/'),
            'create' => Pages\CreateFlight::route('/create'),
            'edit' => Pages\EditFlight::route('/{record}/edit'),
        ];
    }
}
