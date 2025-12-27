<?php

namespace App\Filament\Employee\Widgets;

use App\Models\Bid;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BidderStats extends StatsOverviewWidget
{
    /**
     * Build the stats for the widget.
     */
    protected function getStats(): array
    {
        $uid = auth()->id();

        return [
            Stat::make('Total Bids', Bid::where('assigned_to', $uid)->count())
                ->icon('heroicon-o-list-bullet'),

            Stat::make(
                'Pending',
                Bid::where('assigned_to', $uid)->where('status', 'pending')->count()
            )
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make(
                'Won',
                Bid::where('assigned_to', $uid)->where('status', 'won')->count()
            )
                ->icon('heroicon-o-check')
                ->color('success'),

            Stat::make(
                'Lost',
                Bid::where('assigned_to', $uid)->where('status', 'lost')->count()
            )
                ->icon('heroicon-o-x-mark')
                ->color('danger'),
        ];
    }
}
