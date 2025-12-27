<?php

namespace App\Filament\Employee\Resources\Bids;

use App\Filament\Employee\Resources\Bids\Pages\CreateBid;
use App\Filament\Employee\Resources\Bids\Pages\EditBid;
use App\Filament\Employee\Resources\Bids\Pages\ListBids;
use App\Filament\Employee\Resources\Bids\Schemas\BidForm;
use App\Filament\Employee\Resources\Bids\Tables\BidsTable;
use App\Models\Bid;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BidResource extends Resource
{
    protected static ?string $model = Bid::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';


    public static function form(Schema $schema): Schema
    {
        return BidForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BidsTable::configure($table);
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
            'index' => ListBids::route('/'),
            'create' => CreateBid::route('/create'),
            'edit' => EditBid::route('/{record}/edit'),
        ];
    }
}
