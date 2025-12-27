<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Forms;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('event')
                    ->label('')
                    ->icon(fn ($state) => match ($state) {
                        'created' => 'heroicon-o-plus-circle',
                        'updated' => 'heroicon-o-pencil-square',
                        'deleted' => 'heroicon-o-trash',
                        default => 'heroicon-o-information-circle',
                    })
                    ->color(fn ($state) => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('description')
                    ->label('Action')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('causer.name')
                    ->label('User')
                    ->default('System')
                    ->sortable(),

                TextColumn::make('subject_type')
                    ->label('Model')
                    ->formatStateUsing(fn ($state) => class_basename($state)),

                TextColumn::make('created_at')
                    ->label('Time')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('event')
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                    ]),

                SelectFilter::make('causer_id')
                    ->label('User')
                    ->options(function () {
                        return Activity::query()
                            ->with('causer')
                            ->whereNotNull('causer_id')
                            ->get()
                            ->pluck('causer.name', 'causer_id')
                            ->unique()
                            ->sort();
                    })
                    ->searchable(),

                SelectFilter::make('subject_type')
                    ->label('Model')
                    ->options(function () {
                        return Activity::query()
                            ->select('subject_type')
                            ->distinct()
                            ->get()
                            ->mapWithKeys(fn ($item) => [
                                $item->subject_type => class_basename($item->subject_type),
                            ])
                            ->sort();
                    }),
            ])
            ->actions([
                ViewAction::make(),
                Action::make('view_changes')
                    ->label('Changes')
                    ->icon('heroicon-m-eye')
                    ->modalHeading('Activity Changes')
                    ->modalWidth('3xl')
                    ->modalSubmitAction(false)
                    ->form([
                        Forms\Components\KeyValue::make('old_values')
                            ->label('Old Values')
                            ->columnSpanFull()
                            ->disabled(),

                        Forms\Components\KeyValue::make('new_values')
                            ->label('New Values')
                            ->columnSpanFull()
                            ->disabled(),
                    ])
                    ->fillForm(fn ($record) => [
                        'old_values' => $record->properties['old'] ?? [],
                        'new_values' => $record->properties['attributes'] ?? [],
                    ])
            ])
            ->recordUrl(null)
            ->defaultSort('created_at', 'desc');
    }
}
