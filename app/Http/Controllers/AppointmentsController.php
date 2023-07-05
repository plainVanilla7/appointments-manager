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
        $user = auth()->user();
        $appointments = $user->appointments;
    return view('appointments.my-appointments', compact('appointments'));
}

public function store(Request $request)
{
    $request->validate([
        'date' => 'required|date',
        'time' => 'required',
    ]);

    $user = auth()->user();
    $userName = $user->name;
    $userEmail = $user->email;

    $appointment = $user->appointments()->create([
        'date' => $request->date,
        'time' => $request->time,
        'client_name' => $userName,
        'client_email' => $userEmail,
    ]);

    return redirect()->route('home')->with('success', 'Appointment created successfully.');
}




    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
