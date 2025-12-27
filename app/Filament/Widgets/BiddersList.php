<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class BiddersList extends BaseWidget
{
    protected static ?string $heading = 'Latest Bidders';
    protected int|string|array $columnSpan = 1;

    protected function getTableQuery(): Builder
    {
        return User::role('bidder')->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('created_at')->date(),
        ];
    }
}
