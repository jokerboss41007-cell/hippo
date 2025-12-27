<?php

namespace App\Filament\Employee\Resources\PortfolioProjects;

use App\Filament\Employee\Resources\PortfolioProjects\Pages\CreatePortfolioProject;
use App\Filament\Employee\Resources\PortfolioProjects\Pages\EditPortfolioProject;
use App\Filament\Employee\Resources\PortfolioProjects\Pages\ListPortfolioProjects;
use App\Filament\Employee\Resources\PortfolioProjects\Pages\ViewPortfolioProject;
use App\Filament\Employee\Resources\PortfolioProjects\Schemas\PortfolioProjectForm;
use App\Filament\Employee\Resources\PortfolioProjects\Schemas\PortfolioProjectInfolist;
use App\Filament\Employee\Resources\PortfolioProjects\Tables\PortfolioProjectsTable;
use App\Models\PortfolioProject;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PortfolioProjectResource extends Resource
{
    protected static ?string $model = PortfolioProject::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAsiaAustralia;

    public static function form(Schema $schema): Schema
    {
        return PortfolioProjectForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PortfolioProjectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PortfolioProjectsTable::configure($table);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('bidder');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPortfolioProjects::route('/'),
            'create' => CreatePortfolioProject::route('/create'),
            'view' => ViewPortfolioProject::route('/{record}'),
            'edit' => EditPortfolioProject::route('/{record}/edit'),
        ];
    }
}
