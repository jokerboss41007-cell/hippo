<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\ClientInvoice;
use Illuminate\Support\Facades\DB;

class ProfitLossWidget extends ChartWidget
{
    protected ?string $heading = 'Profit vs Loss';

    protected function getData(): array
    {
        // Group by month extracted from invoice_date
        $invoices = ClientInvoice::select(
                DB::raw("DATE_FORMAT(invoice_date, '%b %Y') as month"),
                DB::raw("SUM(profit) as total_profit"),
                DB::raw("SUM(loss) as total_loss")
            )
            ->groupBy('month')
            ->orderBy(DB::raw("MIN(invoice_date)")) // ensure proper monthly order
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Profit',
                    'data' => $invoices->pluck('total_profit'),
                    'borderColor' => '#16A34A', // green (optional)
                ],
                [
                    'label' => 'Loss',
                    'data' => $invoices->pluck('total_loss'),
                    'borderColor' => '#DC2626', // red (optional)
                ],
            ],
            'labels' => $invoices->pluck('month'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
