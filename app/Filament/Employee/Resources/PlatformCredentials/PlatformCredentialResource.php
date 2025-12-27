<?php

namespace App\Filament\Employee\Resources\PlatformCredentials;

use App\Filament\Employee\Resources\PlatformCredentials\Pages\CreatePlatformCredential;
use App\Filament\Employee\Resources\PlatformCredentials\Pages\EditPlatformCredential;
use App\Filament\Employee\Resources\PlatformCredentials\Pages\ListPlatformCredentials;
use App\Filament\Employee\Resources\PlatformCredentials\Pages\ViewPlatformCredential;
use App\Filament\Employee\Resources\PlatformCredentials\Schemas\PlatformCredentialForm;
use App\Filament\Employee\Resources\PlatformCredentials\Schemas\PlatformCredentialInfolist;
use App\Filament\Employee\Resources\PlatformCredentials\Tables\PlatformCredentialsTable;
use App\Models\PlatformCredential;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PlatformCredentialResource extends Resource
{
    protected static ?string $model = PlatformCredential::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    public static function form(Schema $schema): Schema
    {
        return PlatformCredentialForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PlatformCredentialInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlatformCredentialsTable::configure($table);
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
            'index' => ListPlatformCredentials::route('/'),
            // 'create' => CreatePlatformCredential::route('/create'),
            'view' => ViewPlatformCredential::route('/{record}'),
            // 'edit' => EditPlatformCredential::route('/{record}/edit'),
        ];
    }
}
