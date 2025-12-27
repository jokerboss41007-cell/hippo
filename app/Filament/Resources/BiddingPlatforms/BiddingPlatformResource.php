<?php

namespace App\Filament\Resources\BiddingPlatforms;

use App\Filament\Resources\BiddingPlatforms\Pages\CreateBiddingPlatform;
use App\Filament\Resources\BiddingPlatforms\Pages\EditBiddingPlatform;
use App\Filament\Resources\BiddingPlatforms\Pages\ListBiddingPlatforms;
use App\Filament\Resources\BiddingPlatforms\Pages\ViewBiddingPlatform;
use App\Filament\Resources\BiddingPlatforms\Schemas\BiddingPlatformForm;
use App\Filament\Resources\BiddingPlatforms\Schemas\BiddingPlatformInfolist;
use App\Filament\Resources\BiddingPlatforms\Tables\BiddingPlatformsTable;
use App\Models\BiddingPlatform;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BiddingPlatformResource extends Resource
{
    protected static ?string $model = BiddingPlatform::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    public static function form(Schema $schema): Schema
    {
        return BiddingPlatformForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BiddingPlatformInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BiddingPlatformsTable::configure($table);
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
            'index' => ListBiddingPlatforms::route('/'),
            'create' => CreateBiddingPlatform::route('/create'),
            'view' => ViewBiddingPlatform::route('/{record}'),
            'edit' => EditBiddingPlatform::route('/{record}/edit'),
        ];
    }
}
