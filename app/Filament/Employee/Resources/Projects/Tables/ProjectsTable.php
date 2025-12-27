<?php

namespace App\Filament\Employee\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('client_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('bid_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('project_manager')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('project_link')
                    ->searchable(),
                TextColumn::make('deadline')
                    ->date()
                    ->sortable(),
                TextColumn::make('completed_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('technology')
                    ->searchable(),
                TextColumn::make('project_budget')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('final_cost')
                    ->money()
                    ->sortable(),
                TextColumn::make('profit')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('loss')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
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
