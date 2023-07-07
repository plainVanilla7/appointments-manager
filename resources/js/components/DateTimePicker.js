import React, { useState } from 'react';

const DateTimePicker = () => {
    const [selectedDate, setSelectedDate] = useState(null);
    const [selectedTime, setSelectedTime] = useState(null);

    const handleDateClick = (date) => {
        setSelectedDate(date);
    };

    const handleTimeClick = (time) => {
        setSelectedTime(time);
    };

    const renderDateButtons = () => {
        const dates = ['2023-07-07', '2023-07-08', '2023-07-09'];
        return dates.map((date) => (
            <button
                key={date}
                className={`date-button ${selectedDate === date ? 'selected' : ''}`}
                onClick={() => handleDateClick(date)}
            >
                {date}
            </button>
        ));
    };

    const renderTimeButtons = () => {
        const times = ['09:00', '10:00', '11:00', '12:00'];
        return times.map((time) => (
            <button
                key={time}
                className={`time-button ${selectedTime === time ? 'selected' : ''}`}
                onClick={() => handleTimeClick(time)}
            >
                {time}
            </button>
        ));
    };

    return (
        <div>
            <h1>Schedule Appointment</h1>
            <div className="date-picker">
                <h3>Select Date:</h3>
                <div className="date-buttons">{renderDateButtons()}</div>
            </div>
            <div className="time-picker">
                <h3>Select Time:</h3>
                <div className="time-buttons">{renderTimeButtons()}</div>
            </div>
            {selectedDate && selectedTime && (
                <p>
                    Selected Date and Time: {selectedDate} {selectedTime}
                </p>
            )}
        </div>
    );
};

export default DateTimePicker;
