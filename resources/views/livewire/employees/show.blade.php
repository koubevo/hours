@extends('livewire.layouts.admin-layout')

@section('title', $employee->name)

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
                            ['label' => '', 'key' => 'status', 'status_color' => true],
                            ['label' => 'Kdo', 'key' => 'employee.name', 'print_only' => true],
                            ['label' => 'Datum', 'key' => 'formatted_work_date'],
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