<?php

namespace App\Filament\Resources\ActivityLogs\Pages;

use App\Filament\Resources\ActivityLogs\ActivityLogResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
class ViewActivityLog extends ViewRecord
{
    protected static string $resource = ActivityLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }


    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([

                // ===============================
                // TOP SUMMARY CARD
                // ===============================
                Section::make('Activity Summary')
                    ->schema([

                        TextEntry::make('description')
                            ->label(false)
                            ->size('2xl')
                            ->weight('bold')
                            ->extraAttributes(['class' => 'text-gray-800 dark:text-gray-100']),

                        TextEntry::make('event')
                            ->label('Event')
                            ->badge()
                            ->color(fn ($state) => match ($state) {
                                'created' => 'success',
                                'updated' => 'warning',
                                'deleted' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('causer.name')
                            ->label('Performed By')
                            ->default('System'),

                        TextEntry::make('subject_type')
                            ->label('Model')
                            ->formatStateUsing(fn ($state) => class_basename($state)),

                        TextEntry::make('created_at')
                            ->label('Timestamp')
                            ->dateTime(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ===============================
                // OLD VALUES
                // ===============================
                Section::make('Old Values')
                    ->collapsed()
                    ->schema([
                        KeyValueEntry::make('properties.old')
                            ->label(false)
                            ->columnSpanFull(),
                    ])
                    ->visible(fn ($record) => filled($record->properties['old'] ?? null))
                    ->columnSpanFull(),

                // ===============================
                // NEW VALUES
                // ===============================
                Section::make('New Values')
                    ->collapsed()
                    ->schema([
                        KeyValueEntry::make('properties.attributes')
                            ->label(false)
                            ->columnSpanFull(),
                    ])
                    ->visible(fn ($record) => filled($record->properties['attributes'] ?? null))
                    ->columnSpanFull(),
            ]);
    }
}
