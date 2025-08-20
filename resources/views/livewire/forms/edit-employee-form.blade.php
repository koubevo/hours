<form wire:submit.prevent="update">
    @include('components.forms.employee-form')
    <flux:button variant="primary" class="cursor-pointer mt-2" type="submit">
        Uložit změny
    </flux:button>
</form>