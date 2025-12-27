<?php

namespace App\Filament\Employee\Resources\BidConnectionRequests\Pages;

use App\Filament\Employee\Resources\BidConnectionRequests\BidConnectionRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBidConnectionRequest extends EditRecord
{
    protected static string $resource = BidConnectionRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
