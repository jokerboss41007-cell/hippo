<?php

namespace App\Filament\Resources\Roles\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Role')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => ucwords($state))
                    ->weight('bold'),

                TextColumn::make('permissions_count')
                    ->label('Total Permissions')
                    ->counts('permissions')
                    ->badge(),

                TextColumn::make('permissions.name')
                    ->label('Assigned Permissions')
                    ->badge()
                    ->limit(50)
                    ->wrap(),
            ])

            ->actions([
                EditAction::make(),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
