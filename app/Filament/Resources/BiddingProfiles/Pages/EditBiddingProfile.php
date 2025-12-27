<?php

namespace App\Filament\Resources\BiddingProfiles\Pages;

use App\Filament\Resources\BiddingProfiles\BiddingProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBiddingProfile extends EditRecord
{
    protected static string $resource = BiddingProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
