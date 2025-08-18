<form wire:submit.prevent="store">
    @livewire('forms.hours-form')
    <flux:button class="cursor-pointer" type="submit">
        Přidat
    </flux:button>
</form>