<?php

namespace App\Filament\Employee\Resources\BidConnectionRequests;

use App\Filament\Employee\Resources\BidConnectionRequests\Pages\CreateBidConnectionRequest;
use App\Filament\Employee\Resources\BidConnectionRequests\Pages\EditBidConnectionRequest;
use App\Filament\Employee\Resources\BidConnectionRequests\Pages\ListBidConnectionRequests;
use App\Filament\Employee\Resources\BidConnectionRequests\Schemas\BidConnectionRequestForm;
use App\Filament\Employee\Resources\BidConnectionRequests\Tables\BidConnectionRequestsTable;
use App\Models\BidConnection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BidConnectionRequestResource extends Resource
{
    protected static ?string $model = BidConnection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPaperAirplane;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return BidConnectionRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BidConnectionRequestsTable::configure($table);
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
            'index' => ListBidConnectionRequests::route('/'),
            'create' => CreateBidConnectionRequest::route('/create'),
            'edit' => EditBidConnectionRequest::route('/{record}/edit'),
        ];
    }
}
