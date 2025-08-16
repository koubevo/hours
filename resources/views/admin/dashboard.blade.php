@extends('components.layouts.admin')

@section('title', 'Domů')

@section('content')

    <x-today-hours :employees="$employees" />

    <!-- TODO: calendar -->

@endsection