@extends('livewire.layouts.admin-layout')

@section('title', $employee->name)

@section('content')

    <section class="space-y-4">
        <div class="w-full">
            @livewire('ui.button-group', [
                'buttons' => [
                    [
                        'text' => 'Přidat hodiny',
                        'route' => route('hours.create', ['employee' => $employee->id]),
                        'icon' => 'plus'
                    ],
                    [
                        'text' => 'Zaplatit',
                        'route' => route('payment.create', ['employee' => $employee->id]),
                        'icon' => 'banknotes'
                    ],
                    [
                        'text' => 'Upravit data zaměstnance',
                        'route' => route('employee.edit', ['employee' => $employee]),
                        'icon' => 'pencil'
                    ],
                    [
                        'text' => 'Skrýt zaměstnance',
                        'icon' => 'eye-slash'
                    ],
                ]
            ])
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            <x-card>
                <div class="flex items-center gap-2 mb-1">
                @if ($employee->hasDraftHoursToday())
                    <flux:badge color="amber" size="sm">Rozděláno</flux:badge>
                @endif
                        <flux:text>Dnešní hodiny</flux:text>
                    </div>
                    <flux:heading size="xl">
                        @if ($employee->hasHoursToday())
                            @foreach ($employee->todayHours() as $todayHours)
                                {{ $todayHours->start_time }} - {{ $todayHours->end_time ?? '??' }}@if (!$loop->last), @endif
                            @endforeach
                        @endif
                        @if (!$employee->hasHoursToday())
                            <span class="text-red-500">Nevyplněno</span>
                        @endif
                    </flux:heading>
                </x-card>
                <x-card>
                    <flux:text class="mb-1">Dluh vůči zaměstnanci</flux:text>
                    <flux:heading size="xl" class="{{ $employee->debt() > 0 ? 'text-red-500' : '' }}">{{ $employee->debt() }} Kč</flux:heading>
                </x-card>
            </div>
            @if (!empty($employee->hours))
                @livewire('ui.table', [
                    'columns' => [
                        ['label' => '', 'key' => 'status', 'status_color' => true],
                        ['label' => 'Kdo', 'key' => 'employee.name', 'print_only' => true],
                        ['label' => 'Datum', 'key' => 'formatted_work_date'],
                        ['label' => 'Od', 'key' => 'start_time'],
                        ['label' => 'Do', 'key' => 'end_time'],
                        ['label' => 'Částka', 'key' => 'earning', 'countable' => true],
                    ],
                    'rows' => $employee->hours,
                    'showMonthSelector' => true,
                    'editRoute' => 'hours.edit',
                    'deleteModel' => \App\Models\Hour::class,
                ])
            @endif
    </section>
@endsection