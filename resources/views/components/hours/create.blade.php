@extends('components.layouts.admin')

@section('title', 'Přidat hodiny')

@section('content')
    @livewire('forms.add-hours-form', [
        'preselectedEmployee' => $preselectedEmployee ?? null,
        'preselectedDate' => $preselectedDate ?? null
    ])
@endsection