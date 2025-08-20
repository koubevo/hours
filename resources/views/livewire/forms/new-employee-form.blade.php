<form wire:submit.prevent="store" class="space-y-4">
    @include('components.forms.employee-form')
    <flux:button variant="primary" class="cursor-pointer mt-2" type="submit">
        Přidat
    </flux:button>
</form>