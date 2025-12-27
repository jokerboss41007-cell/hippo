<?php

namespace App\Filament\Resources\BiddingPlatforms\Pages;

use App\Filament\Resources\BiddingPlatforms\BiddingPlatformResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBiddingPlatforms extends ListRecords
{
    protected static string $resource = BiddingPlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
