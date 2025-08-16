<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
})->name('home');

Route::view('admin/login', 'admin.login')
    ->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::view('/', 'admin.dashboard')
        ->name('admin.dashboard');

    Route::resource('/employee', EmployeeController::class);

});

require __DIR__ . '/auth.php';
