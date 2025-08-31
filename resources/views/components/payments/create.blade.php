@extends('livewire.layouts.admin-layout')

@section('title', 'Přidat platbu')

@section('content')
    @livewire('forms.payment-form', [
        'employee' => $preselectedEmployee ?? null
    ])
@endsection