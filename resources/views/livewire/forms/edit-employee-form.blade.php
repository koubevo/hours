<form wire:submit.prevent="update">
    @include('components.forms.employee-form')
    <flux:button class="cursor-pointer" type="submit">
        Uložit změny
    </flux:button>
</form>