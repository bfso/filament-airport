<?php

namespace App\Filament\Resources\Flights\Tables;


use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;

class FlightsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->sortable(),

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
                DeleteAction::make(),
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
}
