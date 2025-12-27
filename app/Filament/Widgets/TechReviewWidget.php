<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Project;

class TechReviewWidget extends ChartWidget
{
    protected ?string $heading = 'Tech Review Widget';

    protected function getData(): array
    {
        $tech = Project::selectRaw('technology, count(*) as total')->groupBy('technology')->get();

        return [
            'datasets' => [[
                'label' => 'Tech Count',
                'data' => $tech->pluck('total'),
            ]],
            'labels' => $tech->pluck('technology'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
