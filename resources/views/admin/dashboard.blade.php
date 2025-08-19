@extends('livewire.layouts.admin-layout')

@section('title', 'Domů')

@section('content')

    <x-today-hours :employees="$employees" />

    <!-- TODO: calendar -->

@endsection