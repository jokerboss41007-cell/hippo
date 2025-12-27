<?php

namespace App\Filament\Employee\Pages;

use App\Models\Bid;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class BidderDashboard extends Page
{
    protected string $view = 'filament.employee.pages.bidder-dashboard';

    protected static ?string $title = 'Bidding Dashboard';

    public static function getNavigationIcon(): BackedEnum|string|null
    {
        return Heroicon::OutlinedHome;
    }
    public static function getNavigationLabel(): string
    {
        return 'Dashboard';
    }

    // (Optional) Group in sidebar
    // public static function getNavigationGroup(): ?string
    // {
    //     return 'Employee';
    // }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('bidder');
    }

    public function getBidStats(): array
    {
        $query = Bid::where('assigned_to', auth()->id());

        return [
            'total'   => (clone $query)->count(),
            'pending' => (clone $query)->where('status', 'pending')->count(),
            'won'     => (clone $query)->where('status', 'won')->count(),
            'lost'    => (clone $query)->where('status', 'lost')->count(),
        ];
    }
}
