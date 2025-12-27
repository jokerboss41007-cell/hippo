<x-filament::page>

    {{-- Stats cards --}}
    @livewire(\App\Filament\Employee\Widgets\BidderStats::class)

    <div class="mt-6">
        @livewire(\App\Filament\Employee\Widgets\BidderRecentBids::class)
    </div>

</x-filament::page>
