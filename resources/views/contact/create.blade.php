@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Contact Admin</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ url('/contact-admin') }}">
        @csrf

        <div class="mb-3">
            <label>Your Name</label>
            <input name="user_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phone Number</label>
            <input name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Problem Type</label>
            <select name="problem_type" class="form-control" required>
                <option value="">Select Problem Type</option>
                <option value="Appointment Issue">Appointment Issue</option>
                <option value="Car Service">Car Service</option>
                <option value="Billing">Billing</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Problem Description</label>
            <textarea name="problem_description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ url('/book-appointment') }}" class="btn btn-secondary">Back to Appointments</a>
        </div>
    </form>
</div>
@endsection