<form wire:submit.prevent="store" class="space-y-4">
    @include('components.forms.employee-form')
    <flux:button class="cursor-pointer mt-2" type="submit">
        Přidat
    </flux:button>
</form>