<?php

namespace App\Filament\Resources\Passengers\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PassengersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
//                Tables\Columns\TextColumn::make('collision')->getStateUsing(
//                    function (Passenger $record) {
//                        return FlightCollisionDetector::run($record);
//                    }
//                ),

                Tables\Columns\TextColumn::make('flights.number')
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                //$query->with('flights');
            })
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
