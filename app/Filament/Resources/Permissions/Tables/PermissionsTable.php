<?php

namespace App\Filament\Resources\Permissions\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Str;

class PermissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // Group AFTER retrieval (avoid SQL group by)
            ->groups([
                Group::make('module')
                    ->label('Module')
                    ->collapsible()
                    ->getTitleFromRecordUsing(fn ($record) => Str::title(self::extractModule($record->name))),
            ])

            ->columns([
                TextColumn::make('action')
                    ->label('Action')
                    ->getStateUsing(fn ($record) => Str::title(self::extractAction($record->name)))
                    ->sortable(false),

                TextColumn::make('module')
                    ->label('Module')
                    ->getStateUsing(fn ($record) => Str::title(self::extractModule($record->name)))
                    ->sortable(false),

                TextColumn::make('name')
                    ->label('Full Permission Name')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created'),
            ])

            ->actions([ EditAction::make() ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])

            // ⚠ STOP Filament from sorting/grouping via SQL
            ->defaultSort('id');
    }

    private static function extractAction(string $name): string
    {
        return explode(' ', $name)[0] ?? $name;
    }

    private static function extractModule(string $name): string
    {
        return explode(' ', $name, 2)[1] ?? 'general';
    }
}
