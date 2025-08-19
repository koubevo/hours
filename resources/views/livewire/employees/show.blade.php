@extends('livewire.layouts.admin-layout')

@section('title', !empty($employee->nickname) ? $employee->nickname : $employee->name)

@section('content')

<section>
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
</section>

@endsection