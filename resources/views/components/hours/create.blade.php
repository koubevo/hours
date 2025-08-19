@extends('livewire.layouts.admin-layout')

@section('title', 'Přidat hodiny')

@section('content')
    @livewire('forms.hours-form', [
        'employee' => $preselectedEmployee ?? null,
        'date' => $preselectedDate ?? null
    ])
@endsection