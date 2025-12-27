<?php

namespace App\Filament\Resources\PlatformCredentials;

use App\Filament\Resources\PlatformCredentials\Pages\CreatePlatformCredential;
use App\Filament\Resources\PlatformCredentials\Pages\EditPlatformCredential;
use App\Filament\Resources\PlatformCredentials\Pages\ListPlatformCredentials;
use App\Filament\Resources\PlatformCredentials\Schemas\PlatformCredentialForm;
use App\Filament\Resources\PlatformCredentials\Tables\PlatformCredentialsTable;
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
            'create' => CreatePlatformCredential::route('/create'),
            'edit' => EditPlatformCredential::route('/{record}/edit'),
        ];
    }
}
