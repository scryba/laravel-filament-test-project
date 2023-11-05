<x-filament-panels::page>

    <p>
        After uploading allow up to 20 minutes for the background processor to import your galleries
        for display.
    </p>

    <x-filament-panels::form wire:submit="submitForm">

        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getFormActions()"
        />

        <x-filament-actions::modals />

    </x-filament-panels::form>


</x-filament-panels::page>
