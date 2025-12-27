<?php

namespace App\Filament\Resources\PlatformCredentials\Pages;

use App\Filament\Resources\PlatformCredentials\PlatformCredentialResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPlatformCredentials extends ListRecords
{
    protected static string $resource = PlatformCredentialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
