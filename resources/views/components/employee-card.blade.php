@props(['employee'])
<a href="{{ route('hours.create', ['employee' => $employee->id]) }}" class="block">
    <x-card>
        <flux:heading>{{ !empty($employee->nickname) ? $employee->nickname : $employee->name }}</flux:heading>
        <flux:text class="mt-2">
            <flux:badge color="green" size="sm" class="me-2">Vyplněno</flux:badge>
            8:00 - 16:00
        </flux:text>
    </x-card>
</a>