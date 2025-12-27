<?php

namespace App\Filament\Employee\Resources\PlatformCredentials\Pages;

use App\Filament\Employee\Resources\PlatformCredentials\PlatformCredentialResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPlatformCredential extends EditRecord
{
    protected static string $resource = PlatformCredentialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
