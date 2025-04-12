@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Book an Appointment</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/book-appointment" method="POST" id="appointmentForm">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Phone Number</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Car License Number</label>
                <input type="text" name="car_license" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Car Engine Number</label>
                <input type="text" name="car_engine" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control" 
                    min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Select Mechanic</label>
                <select name="mechanic_id" id="mechanic_select" class="form-control" required>
                    <option value="">-- Select a Mechanic --</option>
                    @foreach($mechanics as $m)
                        @if($m->slots_left > 0)
                        <option value="{{ $m->id }}" data-slots="{{ $m->slots_left }}">{{ $m->name }} ({{ $m->slots_left }} slots available)</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Select Time Slot</label>
                <select name="time_slot" id="time_slot_select" class="form-control" required disabled>
                    <option value="">-- Select a Date and Mechanic First --</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Book Appointment</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('appointment_date');
    const mechanicSelect = document.getElementById('mechanic_select');
    const timeSlotSelect = document.getElementById('time_slot_select');

    // Function to update available mechanics based on date
    function updateAvailableMechanics() {
        const selectedDate = dateInput.value;
        
        if (!selectedDate) return;

        // Clear mechanic selection
        mechanicSelect.innerHTML = '<option value="">-- Loading Mechanics --</option>';
        
        // Fetch available mechanics for selected date
        fetch(`/api/available-mechanics?date=${selectedDate}`)
            .then(response => response.json())
            .then(mechanics => {
                mechanicSelect.innerHTML = '<option value="">-- Select a Mechanic --</option>';
                mechanics.forEach(mechanic => {
                    if (mechanic.slots_left > 0) {
                        const option = document.createElement('option');
                        option.value = mechanic.id;
                        option.textContent = `${mechanic.name} (${mechanic.slots_left} slots available)`;
                        option.dataset.slotsLeft = mechanic.slots_left;
                        option.dataset.timeSlots = JSON.stringify(mechanic.available_slots);
                        mechanicSelect.appendChild(option);
                    }
                });
                
                if (mechanicSelect.options.length <= 1) {
                    const option = document.createElement('option');
                    option.textContent = 'No mechanics available on this date';
                    option.disabled = true;
                    mechanicSelect.appendChild(option);
                }
            });
    }

    // Update time slots based on selected mechanic
    function updateTimeSlots() {
        timeSlotSelect.innerHTML = '<option value="">-- Select a Time Slot --</option>';
        timeSlotSelect.disabled = true;
        
        const selectedOption = mechanicSelect.options[mechanicSelect.selectedIndex];
        if (!selectedOption || !selectedOption.value) return;
        
        try {
            const timeSlots = JSON.parse(selectedOption.dataset.timeSlots);
            if (timeSlots && timeSlots.length) {
                timeSlots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot;
                    option.textContent = slot;
                    timeSlotSelect.appendChild(option);
                });
                timeSlotSelect.disabled = false;
            }
        } catch (e) {
            console.error('Error parsing time slots:', e);
        }
    }

    // Set up event listeners
    dateInput.addEventListener('change', updateAvailableMechanics);
    mechanicSelect.addEventListener('change', updateTimeSlots);
    
    // Initialize if date is pre-filled (e.g., after validation error)
    if (dateInput.value) {
        updateAvailableMechanics();
    }
});
</script>
@endsection
