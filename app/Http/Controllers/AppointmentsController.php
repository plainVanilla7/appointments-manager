<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use Carbon\Carbon;

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

public function checkAvailability(Request $request)
{
    $date = $request->input('date');
    $time = $request->input('time');
    $endTime = \Carbon\Carbon::createFromFormat('H:i', $time)->addHour()->format('H:i');

    $count = Appointment::where(function ($query) use ($date, $time, $endTime) {
        $query->where(function ($query) use ($date, $time) {
            $query->where('date', $date)
                ->where('time', $time);
        })->orWhere(function ($query) use ($date, $endTime) {
            $query->where('date', $date)
                ->where('time', $endTime);
        });
    })->count();

    return response()->json([
        'available' => $count === 0
    ]);
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
    $date = $request->date;
    $time = $request->time;

    $existingAppointment = Appointment::where('date', $date)
        ->where('time', $time)
        ->first();

    if ($existingAppointment) {
        return redirect()->back()->with('error', 'Unfortunately an appointment already exists at that date and time.');
    }

    $appointment = $user->appointments()->create([
        'date' => $date,
        'time' => $time,
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
