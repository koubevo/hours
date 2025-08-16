<form wire:submit.prevent="update">
    @include('components.forms.employee-form')
    <flux:button class="cursor-pointer">
        Uložit změny
    </flux:button>
</form>