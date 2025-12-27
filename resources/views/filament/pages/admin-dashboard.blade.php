<x-filament::page>

    {{-- ======================  STATS OVERVIEW  ====================== --}}
    <div class="mt-6"> {{-- margin top applied --}}
        @livewire(\App\Filament\Widgets\DashboardStats::class)
    </div>

    {{-- ======================  WIDGET GRID ====================== --}}

        <x-filament::section heading="Bidders" class="min-h-[280px] mt-6">
            @livewire(\App\Filament\Widgets\BiddersList::class)
        </x-filament::section>

        {{-- Technologies Review --}}
        <x-filament::section heading="Technologies Review" class="min-h-[280px] mt-6">
            @livewire(\App\Filament\Widgets\TechReviewWidget::class)
        </x-filament::section>

        {{-- Profit & Loss --}}
        <x-filament::section heading="Profit & Loss" class="min-h-[280px] mt-6">
            @livewire(\App\Filament\Widgets\ProfitLossWidget::class)
        </x-filament::section>



</x-filament::page>
