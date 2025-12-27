<?php

namespace App\Filament\Employee\Widgets;

use App\Models\Bid;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class BidderRecentBids extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Recent Bids';

    protected function getTableQuery(): Builder
    {
        return Bid::where('assigned_to', auth()->id())->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')
                ->label('Bid Title')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('biddingProfile.profile_name')
                ->badge()
                ->sortable(),

            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors([
                    'warning' => 'pending',
                    'info'    => 'interviewing',
                    'success' => 'won',
                    'danger'  => 'lost',
                ])
                ->sortable(),

            Tables\Columns\TextColumn::make('bid_amount')
                ->money('USD')
                ->sortable(),
        ];
    }
}
