@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Book an Appointment</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ url('/book-appointment') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Car License Number</label>
            <input name="car_license" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Car Engine Number</label>
            <input name="car_engine" type="number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Appointment Date</label>
            <input name="appointment_date" type="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Choose Mechanic</label>
            <select name="mechanic_id" class="form-control" required>
                <option value="">Select a Mechanic</option>
                @foreach($mechanics as $m)
                    <option value="{{ $m->id }}" {{ $m->slots_left == 0 ? 'disabled' : '' }}>
                        {{ $m->name }} – 
                        {{ $m->slots_left > 0 
                            ? ($m->slots_left . ' slot(s) left | Next: ' . $m->next_slot_time) 
                            : 'Fully booked' }}
                    </option>
                @endforeach
            </select>
            
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ url('/contact-admin') }}" class="btn btn-secondary">Contact Admin</a>
        </div>
    </form>
</div>

<script>
    const mechanicSelect = document.querySelector('select[name="mechanic_id"]');
    const dateInput = document.querySelector('input[name="appointment_date"]');

    dateInput.addEventListener('change', function () {
        const date = this.value;

        fetch(`/api/available-mechanics?date=${date}`)
            .then(res => res.json())
            .then(data => {
                mechanicSelect.innerHTML = '<option value="">Select a Mechanic</option>';

                data.forEach(m => {
                    const option = document.createElement('option');
                    option.value = m.id;
                    option.disabled = m.slots_left === 0;
                    option.textContent = `${m.name} – ${m.slots_left > 0 ? (m.slots_left + ' slot(s) left | Next: ' + m.next_slot_time) : 'Fully booked'}`;
                    mechanicSelect.appendChild(option);
                });
            });
    });
</script>

</body>
@endsection
