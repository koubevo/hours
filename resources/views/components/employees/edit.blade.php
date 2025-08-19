@extends('livewire.layouts.admin-layout')

@section('title', 'Upravit data zaměstnance')

@section('content')
    @livewire('forms.edit-employee-form', ['employee' => $employee])
@endsection