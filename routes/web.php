<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('admin/login', 'admin.login')
    ->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('/', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('/employee', EmployeeController::class);

});

require __DIR__ . '/auth.php';
