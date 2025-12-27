<?php

namespace App\Filament\Resources\BiddingProfiles;

use App\Filament\Resources\BiddingProfiles\Pages\CreateBiddingProfile;
use App\Filament\Resources\BiddingProfiles\Pages\EditBiddingProfile;
use App\Filament\Resources\BiddingProfiles\Pages\ListBiddingProfiles;
use App\Filament\Resources\BiddingProfiles\Pages\ViewBiddingProfile;
use App\Filament\Resources\BiddingProfiles\Schemas\BiddingProfileForm;
use App\Filament\Resources\BiddingProfiles\Schemas\BiddingProfileInfolist;
use App\Filament\Resources\BiddingProfiles\Tables\BiddingProfilesTable;
use App\Models\BiddingProfile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BiddingProfileResource extends Resource
{
    protected static ?string $model = BiddingProfile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    public static function form(Schema $schema): Schema
    {
        return BiddingProfileForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BiddingProfileInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BiddingProfilesTable::configure($table);
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
            'index' => ListBiddingProfiles::route('/'),
            'create' => CreateBiddingProfile::route('/create'),
            'view' => ViewBiddingProfile::route('/{record}'),
            'edit' => EditBiddingProfile::route('/{record}/edit'),
        ];
    }
}
