@extends('layouts.app')

@section('content')
<div class='text-center'>
    <form action="{{ route('appointments.store') }}" method="POST" class="form-container">
        @csrf

        <div class="form-group" id="date-group">
            <label for="date">What would be a convenable day?</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <div class="form-group" id="time-group" style="display: none;">
            <label for="time">Time:</label>
            <input type="time" name="time" id="time" class="form-control" required>
        </div>
          <span id="availability-error" class="text-danger" style="display: none;">Date not available</span>
        <button type="submit" id="submit-btn" class="btn btn-primary" style="display: none;">Create Appointment</button>
    </form>
</div>

<script>
    var dateInput = document.getElementById('date');
    var timeInput = document.getElementById('time');
    var submitBtn = document.getElementById('submit-btn');

    dateInput.addEventListener('change', function() {
        var timeGroup = document.getElementById('time-group');
        if (this.value !== '') {
            timeGroup.style.display = 'block';
        } else {
            timeGroup.style.display = 'none';
        }
        updateSubmitButtonVisibility();
    });

    timeInput.addEventListener('change', function() {
        updateSubmitButtonVisibility();
    });

    function updateSubmitButtonVisibility() {
        if (dateInput.value !== '' && timeInput.value !== '') {
            submitBtn.style.display = 'block';
        } else {
            submitBtn.style.display = 'none';
        }
    }
</script>

<style>
    .form-container {
        max-width: 400px;
        margin: 0 auto;
    }
</style>

@endsection
