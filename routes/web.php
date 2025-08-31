<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HoursController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('admin/login', 'admin.login')
    ->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('/', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('/employee', EmployeeController::class)
        ->only(['create', 'show', 'edit', 'hide']);

    Route::resource('/hours', HoursController::class)
        ->only(['create', 'edit']);

    Route::resource('/payments', PaymentController::class)
        ->only(['index', 'create', 'edit', 'destroy']);
});

require __DIR__ . '/auth.php';
