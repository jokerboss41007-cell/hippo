<?php

namespace App\Filament\Resources\BiddingPlatforms\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;

class BiddingPlatformsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title')
                    ->label('Platform')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => fn ($state) => $state == 1,
                        'danger'  => fn ($state) => $state == 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive'),

                TextColumn::make('current_connection_balance')
                    ->label('Connects')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('per_connection_cost')
                    ->label('Cost Per Connect')
                    // ->suffix(' ₹')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('minimum_threshold_connection')
                    ->label('Min Threshold')
                    ->badge()
                    ->color('warning'),

                TextColumn::make('conversion_rate')
                    ->label('Conversion')
                    // ->suffix('%')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->sortable(),
            ])

            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
