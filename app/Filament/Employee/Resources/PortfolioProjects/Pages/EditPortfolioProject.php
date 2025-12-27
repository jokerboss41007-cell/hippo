<?php

namespace App\Filament\Employee\Resources\PortfolioProjects\Pages;

use App\Filament\Employee\Resources\PortfolioProjects\PortfolioProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioProject extends EditRecord
{
    protected static string $resource = PortfolioProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
