<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
})->name('home');

Route::view('admin/dashboard', 'admin.dashboard')
    ->middleware(['admin'])
    ->name('admin.dashboard');

require __DIR__ . '/auth.php';
