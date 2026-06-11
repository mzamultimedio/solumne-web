<x-filament-panels::page>
    <div class="space-y-6" x-data>
        {{ $this->form }}

        <div class="flex justify-end">
            <x-filament::button wire:click="save" color="warning" icon="heroicon-o-sparkles">
                Guardar instrucciones
            </x-filament::button>
        </div>
    </div>
</x-filament-panels::page>
