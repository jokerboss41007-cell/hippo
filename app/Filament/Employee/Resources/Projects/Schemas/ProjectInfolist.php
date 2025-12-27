<?php

namespace App\Filament\Employee\Resources\Projects\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('status'),
                TextEntry::make('start_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('end_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('client_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('bid_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('project_manager')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('project_link')
                    ->placeholder('-'),
                TextEntry::make('deadline')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('completed_at')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('technology')
                    ->placeholder('-'),
                TextEntry::make('project_budget')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('final_cost')
                    ->money()
                    ->placeholder('-'),
                TextEntry::make('profit')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('loss')
                    ->numeric()
                    ->placeholder('-'),
            ]);
    }
}
