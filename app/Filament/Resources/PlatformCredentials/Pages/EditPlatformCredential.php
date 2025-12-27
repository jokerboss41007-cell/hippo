<?php

namespace App\Filament\Resources\PlatformCredentials\Pages;

use App\Filament\Resources\PlatformCredentials\PlatformCredentialResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPlatformCredential extends EditRecord
{
    protected static string $resource = PlatformCredentialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
