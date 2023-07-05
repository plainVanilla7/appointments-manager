@extends('layouts.app')

@section('content')
    <h1>My Appointments</h1>

    @if ($appointments->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>{{ $appointment->client_name }}</td>
                        <td>{{ $appointment->client_email }}</td>
                        <td>
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You don't have any appointments.</p>
    @endif
@endsection
