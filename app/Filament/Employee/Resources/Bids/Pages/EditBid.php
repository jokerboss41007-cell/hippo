<?php

namespace App\Filament\Employee\Resources\Bids\Pages;

use App\Filament\Employee\Resources\Bids\BidResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBid extends EditRecord
{
    protected static string $resource = BidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}
