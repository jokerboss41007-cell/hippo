<?php

namespace App\Filament\Resources\BiddingProfiles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BiddingProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('biddingPlatform.title')
                    ->label('Platform')
                    ->sortable()
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('profile_name')
                    ->label('Profile')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-o-envelope')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('category')
                    ->badge()
                    ->color('warning')
                    ->toggleable(),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->suffix('/10')
                    ->badge()
                    ->color('purple')
                    ->sortable(),

                TextColumn::make('connects_or_tokens')
                    ->label('Connects')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger'  => 'inactive',
                    ])
                    ->label('Status'),

                TextColumn::make('created_at')
                    ->since()
                    ->label('Added')
                    ->sortable(),
            ])

            ->defaultSort('created_at', 'desc')

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
