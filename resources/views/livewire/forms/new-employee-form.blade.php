<form wire:submit.prevent="submit" class="space-y-4">
    @include('components.forms.employee-form')
    <flux:button class="cursor-pointer" type="submit">
        Přidat
    </flux:button>
</form>