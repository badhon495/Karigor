@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Track Your Appointments</h2>

    <form method="POST" action="{{ url('/track') }}">
        @csrf
        <div class="input-group mb-3">
            <input name="phone" class="form-control" placeholder="Enter your phone number" required>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    @isset($appointments)
        @if($appointments->isEmpty())
            <div class="alert alert-warning">No appointments found.</div>
        @else
            <h4>Appointments:</h4>
            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Car License</th>
                        <th>Car Engine</th>
                        <th>Date</th>
                        <th>Mechanic</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $a)
                        <tr>
                            <td>{{ $a->name }}</td>
                            <td>{{ $a->car_license }}</td>
                            <td>{{ $a->car_engine }}</td>
                            <td>{{ $a->appointment_date }}</td>
                            <td>{{ $a->mechanic->name ?? 'N/A' }}</td>
                            <td>{{ $a->time_slot }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endisset
</div>
@endsection
