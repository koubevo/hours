<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
})->name('home');

Route::view('admin/login', 'admin.login')
    ->name('admin.login');

Route::group(['middleware' => 'admin'], function () {
    Route::view('admin/dashboard', 'admin.dashboard')
        ->name('admin.dashboard');
});

require __DIR__ . '/auth.php';
