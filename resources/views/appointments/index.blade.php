@extends('layouts.app')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@section('content')
<div class='text-center'>
    <form action="{{ route('appointments.store') }}" method="POST" class="form-container">
        @csrf

        <div class="form-group" id="date-group">
            <label for="date">What would be a convenient day?</label>
            <input type="date" name="date" id="date" class="form-control" required>
            <span id="date-error" class="text-danger" style="display: none;">Invalid date selected. Please choose a weekday.</span>
        </div>

        <div class="form-group" id="time-group" style="display: none;">
            <label for="time">Time:</label>
            <input type="time" name="time" id="time" class="form-control" required>
            <span id="time-error" class="text-danger" style="display: none;">Invalid time selected. Please choose a valid time slot.</span>
        </div>

        <span id="availability-error" class="text-danger" style="display: none;">Date not available</span>

        <button type="submit" id="submit-btn" class="btn btn-primary" style="display: none;">Create Appointment</button>
    </form>
</div>

<script>
    var dateInput = document.getElementById('date');
    var timeInput = document.getElementById('time');
    var submitBtn = document.getElementById('submit-btn');

    function updateSubmitButtonVisibility() {
        if (dateInput.value !== '' && timeInput.value !== '') {
            submitBtn.style.display = 'block';
        } else {
            submitBtn.style.display = 'none';
        }
    }

    function updateDateErrorVisibility() {
        var selectedDate = new Date(dateInput.value);
        var dayOfWeek = selectedDate.getDay();
        if (dayOfWeek === 0 || dayOfWeek === 6) {
            document.getElementById('date-error').style.display = 'block';
        } else {
            document.getElementById('date-error').style.display = 'none';
        }
        updateSubmitButtonVisibility();
    }

    function updateTimeErrorVisibility() {
        var selectedTime = timeInput.value;
        var timeParts = selectedTime.split(':');
        var hour = parseInt(timeParts[0], 10);
        var minute = parseInt(timeParts[1], 10);
        var validTimeRange1Start = 9;
        var validTimeRange1End = 13;
        var validTimeRange2Start = 15;
        var validTimeRange2End = 21;

        if (
            (hour >= validTimeRange1Start && hour < validTimeRange1End) ||
            (hour === validTimeRange2Start && minute >= 30) ||
            (hour > validTimeRange2Start && hour < validTimeRange2End) ||
            (hour === validTimeRange2End && minute === 0)
        ) {
            document.getElementById('time-error').style.display = 'none';
        } else {
            document.getElementById('time-error').style.display = 'block';
        }
        updateSubmitButtonVisibility();
    }

    dateInput.addEventListener('change', function() {
        var timeGroup = document.getElementById('time-group');
        if (this.value !== '') {
            timeGroup.style.display = 'block';
        } else {
            timeGroup.style.display = 'none';
        }
        updateDateErrorVisibility();
    });

    timeInput.addEventListener('change', function() {
        updateTimeErrorVisibility();
    });
</script>

<style>
    .form-container {
        max-width: 400px;
        margin: 0 auto;
    }
</style>

@endsection
