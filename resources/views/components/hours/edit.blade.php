@extends('livewire.layouts.admin-layout')

@section('title', 'Upravit hodiny')

@section('content')
    @livewire('forms.hours-form', [
        'hour_id' => $hourId
    ])
@endsection
