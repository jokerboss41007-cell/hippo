<?php

namespace App\Filament\Employee\Resources\BidConnectionRequests\Pages;

use App\Filament\Employee\Resources\BidConnectionRequests\BidConnectionRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBidConnectionRequests extends ListRecords
{
    protected static string $resource = BidConnectionRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
