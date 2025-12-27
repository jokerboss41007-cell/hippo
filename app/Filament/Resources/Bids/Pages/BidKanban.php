<?php

namespace App\Filament\Resources\Bids\Pages;

use App\Filament\Resources\Bids\BidResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class BidKanban extends Page
{
    use InteractsWithRecord;

    protected static string $resource = BidResource::class;

    protected string $view = 'filament.resources.bids.pages.bid-kanban';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}
