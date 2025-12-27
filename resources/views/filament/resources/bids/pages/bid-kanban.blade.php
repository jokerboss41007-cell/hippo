<x-filament-panels::page>
    <div x-data="kanbanBoard()" class="grid grid-cols-4 gap-4">

        @foreach (['pending','interviewing','won','lost'] as $status)
        <div class="p-3 rounded-xl bg-gray-50 shadow-sm border"
             @drop="onDrop($event,'{{ $status }}')"
             @dragover.prevent>

            <h2 class="font-bold text-lg capitalize mb-3">{{ $status }}</h2>

            {{-- Cards --}}
            <div class="space-y-3 min-h-[250px]">
                @foreach(\App\Models\Bid::where('status',$status)->get() as $bid)
                <div draggable="true"
                     @dragstart="drag('{{ $bid->id }}')"
                     class="p-3 bg-white rounded-xl shadow cursor-grab border">

                    <div class="font-bold">{{ $bid->title }}</div>
                    <div class="text-xs opacity-60">{{ $bid->platform }}</div>
                    <div class="text-xs mt-1">&#x1F4C5; {{ $bid->deadline ?? 'N/A' }}</div>

                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    {{-- Alpine Logic --}}
    <script>
        function kanbanBoard(){
            return {
                draggedId: null,
                drag(id){ this.draggedId = id; },

                async onDrop(event,status){
                    if(!this.draggedId) return;

                    await fetch(`/bid/update-status/${this.draggedId}/${status}`,{
                        method:"POST",
                        headers:{ "X-CSRF-TOKEN":"{{ csrf_token() }}" }
                    });

                    location.reload(); // refresh column display
                }
            }
        }
    </script>
</x-filament-panels::page>
