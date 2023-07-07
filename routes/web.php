<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/schedule', [App\Http\Controllers\AppointmentsController::class, 'store'])->name('appointments.store');
Route::post('/appointments/checkAvailability', 'AppointmentsController@checkAvailability')->name('appointments.checkAvailability');
Route::get('/schedule', [App\Http\Controllers\AppointmentsController::class, 'index'])->name('appointments.index');
Route::get('/my-appointments', [App\Http\Controllers\AppointmentsController::class, 'myAppointments'])->name('appointments.my-appointments');

Route::delete('/appointments/{appointment}', [App\Http\Controllers\AppointmentsController::class, 'destroy'])->name('appointments.destroy');

