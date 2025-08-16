<form wire:submit.prevent="update">
    @include('components.forms.hours-form')
    <flux:button class="cursor-pointer" type="submit">
        Uložit změny
    </flux:button>
</form>