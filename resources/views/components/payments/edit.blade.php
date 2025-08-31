@extends('livewire.layouts.admin-layout')

@section('title', 'Upravit platbu')

@section('content')
    @livewire('forms.payment-form', [
        'payment_id' => $paymentId ?? null
    ])
@endsection