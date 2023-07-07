<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/schedule', [App\Http\Controllers\AppointmentsController::class, 'store'])->name('appointments.store');
Route::get('/schedule', [App\Http\Controllers\AppointmentsController::class, 'index'])->name('appointments.index');
Route::get('/my-appointments', [App\Http\Controllers\AppointmentsController::class, 'myAppointments'])->name('appointments.my-appointments');
Route::post('/check-availability', 'AppointmentsController@checkAvailability');

Route::delete('/appointments/{appointment}', [App\Http\Controllers\AppointmentsController::class, 'destroy'])->name('appointments.destroy');

