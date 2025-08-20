@extends('livewire.layouts.admin-layout')

@section('title', !empty($employee->nickname) ? $employee->nickname : $employee->name)

@section('content')

<section class="space-y-4">
    @livewire('ui.button-group', [
        'buttons' => [
            [
                'text' => 'Přidat hodiny',
                'route' => route('hours.create', ['employee' => $employee->id])
            ],
            [
                'text' => 'Upravit data zaměstnance',
                'route' => route('employee.edit', ['employee' => $employee])
            ],
            [
                'text' => 'Skrýt zaměstnance',
                'icon' => 'eye-slash'
            ]
        ]
    ])

    @if (!empty($employee->hours))
        @livewire('ui.table', [
            'columns' => [
                ['label' => 'Datum', 'key' => 'work_date'],
                ['label' => 'Od', 'key' => 'start_time'],
                ['label' => 'Do', 'key' => 'end_time'],
                ['label' => 'Částka', 'key' => 'earning', 'countable' => true],
            ],
            'rows' => $employee->hours,
            'showMonthSelector' => true,
            'editRoute' => 'hours.edit'
        ])
    @endif
</section>

@endsection