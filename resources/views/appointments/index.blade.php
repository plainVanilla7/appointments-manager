@extends('layouts.app')

@section('content')
    <h1>Schedule Appointment</h1>
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="time">Time:</label>
            <input type="time" name="time" id="time" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="client_name">Client Name:</label>
            <input type="text" name="client_name" id="client_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="client_email">Client Email:</label>
            <input type="email" name="client_email" id="client_email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Appointment</button>
    </form>
@endsection
