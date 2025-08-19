@extends('livewire.layouts.admin-layout')

@section('title', 'Přidat hodiny')

@section('content')
    @livewire('forms.add-hours-form', [
        'preselectedEmployee' => $preselectedEmployee ?? null,
        'preselectedDate' => $preselectedDate ?? null
    ])
@endsection