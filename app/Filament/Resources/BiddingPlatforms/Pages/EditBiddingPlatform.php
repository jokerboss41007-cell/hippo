<?php

namespace App\Filament\Resources\BiddingPlatforms\Pages;

use App\Filament\Resources\BiddingPlatforms\BiddingPlatformResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBiddingPlatform extends EditRecord
{
    protected static string $resource = BiddingPlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
