<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
class AdminDashboard extends Page
{
    // protected static ?string $navigationIcon  = 'heroicon-o-home';
    protected static ?string $title           = 'Admin Dashboard';
    protected static ?string $navigationLabel = 'Dashboard';
    protected string $view                    = 'filament.pages.admin-dashboard';


    public static function getNavigationIcon(): BackedEnum|string|null
    {
        return Heroicon::OutlinedHome;
    }
    protected function getMaxWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('admin');
    }



}
