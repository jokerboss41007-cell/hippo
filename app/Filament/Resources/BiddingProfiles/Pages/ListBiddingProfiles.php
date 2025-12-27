<?php

namespace App\Filament\Resources\BiddingProfiles\Pages;

use App\Filament\Resources\BiddingProfiles\BiddingProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBiddingProfiles extends ListRecords
{
    protected static string $resource = BiddingProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
