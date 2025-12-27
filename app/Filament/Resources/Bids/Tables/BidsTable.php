<?php

namespace App\Filament\Resources\Bids\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;

class BidsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('platform')->badge()->color('info')->sortable(),
                TextColumn::make('assignedTo.name')->label('Bidder')->badge(),
                TextColumn::make('bid_amount')->money('USD')->sortable(),
                TextColumn::make('status')->badge()->colors([
                    'warning' => 'pending',
                    'info'    => 'interviewing',
                    'success' => 'won',
                    'danger'  => 'lost',
                ]),
                TextColumn::make('deadline')->date()->sortable(),
                TextColumn::make('proposal_url')->label('Proposal')->limit(25)->url(fn ($record) => $record->proposal_url, true),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])

            // ===== Table Row Actions =====
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])

            // ===== Bulk Delete =====
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
