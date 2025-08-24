@extends('livewire.layouts.admin-layout')

@section('title', 'Domů')

@section('content')

    <x-today-hours :employees="$employees" />

    @if (!empty($hours))
        @livewire('ui.table', [
            'columns' => [
                ['label' => 'Kdo', 'key' => 'employee.name', 'route' => 'employee.show'],
                ['label' => 'Datum', 'key' => 'formatted_work_date', 'print_only' => true],
                ['label' => 'Od', 'key' => 'start_time'],
                ['label' => 'Do', 'key' => 'end_time'],
                ['label' => 'Popis', 'key' => 'description', 'shorten' => true],
                ['label' => 'Částka', 'key' => 'earning', 'countable' => true],
            ],
            'rows' => $hours,
            'showMonthSelector' => false,
            'editRoute' => 'hours.edit'
        ])
    @endif

    <!-- TODO: calendar -->

@endsection