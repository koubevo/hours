<form wire:submit.prevent="store">
    @livewire('forms.hours-form', [
        'employee' => $employee,
        'date' => $work_date
    ])
    <flux:button class="cursor-pointer" type="submit">
        Přidat
    </flux:button>
</form>