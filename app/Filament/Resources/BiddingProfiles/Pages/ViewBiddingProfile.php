<?php

namespace App\Filament\Resources\BiddingProfiles\Pages;

use App\Filament\Resources\BiddingProfiles\BiddingProfileResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBiddingProfile extends ViewRecord
{
    protected static string $resource = BiddingProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
