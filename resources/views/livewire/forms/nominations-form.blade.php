<form class="space-y-8">
    <livewire:forms.nominations.sections.basic-details />
    <livewire:forms.nominations.sections.nomination-details />
    <livewire:forms.nominations.sections.story-details />
    <livewire:forms.nominations.sections.reference-details />
    @if ($shouldShowDisclosure)
       <livewire:dialogs.license-and-consent-agreement />
    @else

    @endif    
    <div class="mb-4">
        <x-button wire:click="showDisclosure">Show Disclosure</x-button>
    </div>    


    <x-button type="button" wire:click="submit">Submit</x-button>    
</form>
