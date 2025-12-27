<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\{User, Bid, Project, ClientInvoice};
class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Bidders', User::role('bidder')->count())->icon('heroicon-o-users'),
            Stat::make('Total Projects', Project::count())->icon('heroicon-o-folder'),
            Stat::make('Profit', ClientInvoice::sum('profit'))->icon('heroicon-o-chart-bar')->color('success'),
            Stat::make('Loss', ClientInvoice::sum('loss'))->icon('heroicon-o-chart-bar')->color('danger'),
        ];
    }
}
