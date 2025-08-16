@extends('components.layouts.admin')

@section('title', 'Upravit data zaměstnance')

@section('content')
    @livewire('forms.new-employee-form', ['employee' => $employee])
@endsection