@props(['employee'])
<a href="{{ $employee->hasHoursToday() ? route('employee.show', ['employee' => $employee->id]) : route('hours.create', ['employee' => $employee->id]) }}" class="block">
    <x-card>
        <flux:heading>{{ $employee->name }}</flux:heading>
        <flux:text class="mt-2">
            @if ($employee->hasHoursToday())
                <flux:badge color="green" size="sm" class="me-2">Vyplněno</flux:badge>
                @foreach ($employee->todayHours() as $todayHours)
                    {{ $todayHours->start_time }} - {{ $todayHours->end_time }}@if (!$loop->last), @endif
                @endforeach
            @else
                <flux:badge color="red" size="sm" class="me-2">Nevyplněno</flux:badge>
            @endif
        </flux:text>
    </x-card>
</a>