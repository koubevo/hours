@props(['employee'])
@php
    if ($employee->hasDraftHoursToday()) {
        $route = route('hours.edit', $employee->getDraftHoursToday());
    } elseif ($employee->hasHoursToday()) {
        $route = route('employee.show', ['employee' => $employee->id]);
    } else {
        $route = route('hours.create', ['employee' => $employee->id]);
    }
@endphp
<a href="{{ $route }}" class="block">
    <x-card>
        <flux:heading>{{ $employee->name }}</flux:heading>
        <flux:text class="mt-2">
            @if ($employee->hasHoursToday())
                @if ($employee->hasDraftHoursToday())
                    <flux:badge color="amber" size="sm" class="me-2">Rozděláno</flux:badge>
                @else
                    <flux:badge color="green" size="sm" class="me-2">Vyplněno</flux:badge>
                @endif
                @foreach ($employee->todayHours() as $todayHours)
                    {{ $todayHours->start_time }} - {{ $todayHours->end_time ?? '??' }}@if (!$loop->last), @endif
                @endforeach
            @else
                <flux:badge color="red" size="sm" class="me-2">Nevyplněno</flux:badge>
            @endif
        </flux:text>
    </x-card>
</a>