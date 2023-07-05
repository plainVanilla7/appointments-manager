<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();

        return view('appointments.index', compact('appointments'));
    }

public function myAppointments()
{
    $appointments = Appointment::all();

    return view('appointments.my-appointments', compact('appointments'));
}

public function store(Request $request)
{
    $request->validate([
        'date' => 'required|date',
        'time' => 'required',
        'client_name' => 'required',
        'client_email' => 'required|email',
    ]);

    Appointment::create([
        'date' => $request->date,
        'time' => $request->time,
        'client_name' => $request->client_name,
        'client_email' => $request->client_email,
    ]);

    return redirect()->route('home')->with('success', 'Appointment created successfully.');
}


    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
