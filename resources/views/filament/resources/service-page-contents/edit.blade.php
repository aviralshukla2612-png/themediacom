<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        
        {{-- Custom Blade Form --}}
        @include('filament.resources.service-page-contents.form')
        
        <x-filament-panels::form.actions
            :actions="$this->getFormActions()"
        />
    </x-filament-panels::form>
</x-filament-panels::page>
