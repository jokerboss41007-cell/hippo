<?php

namespace App\Filament\Employee\Resources\PortfolioProjects\Pages;

use App\Filament\Employee\Resources\PortfolioProjects\PortfolioProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioProject extends CreateRecord
{
    protected static string $resource = PortfolioProjectResource::class;
}
