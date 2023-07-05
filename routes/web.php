<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/appointments', [App\Http\Controllers\AppointmentsController::class, 'store'])->name('appointments.store');
Route::get('/appointments', [App\Http\Controllers\AppointmentsController::class, 'index'])->name('appointments.index');
Route::get('/appointments/my-appointments', [App\Http\Controllers\AppointmentsController::class, 'myAppointments'])->name('appointments.my-appointments');

Route::delete('/appointments/{appointment}', [App\Http\Controllers\AppointmentsController::class, 'destroy'])->name('appointments.destroy');

