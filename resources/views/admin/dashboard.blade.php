@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <form action="{{ route('admin.logout') }}" method="POST">@csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>

    <h4>Appointments</h4>
    <table class="table table-bordered mb-5">
        <thead class="table-dark">
            <tr>
                <th>Client</th>
                <th>Phone</th>
                <th>Car</th>
                <th>Engine</th>
                <th>Date</th>
                <th>Time Slot</th>
                <th>Mechanic</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $a)
            <tr>
                <form method="POST" action="{{ url('/admin/update-appointment/' . $a->id) }}">
                    @csrf
                    @method('PUT')
                    <td>{{ $a->name }}</td>
                    <td>{{ $a->phone }}</td>
                    <td>{{ $a->car_license }}</td>
                    <td>{{ $a->car_engine }}</td>
                    <td>
                        <input type="date" name="appointment_date" class="form-control" value="{{ $a->appointment_date }}">
                    </td>
                    <td>{{ $a->time_slot }}</td>
                    <td>
                        <select name="mechanic_id" class="form-control">
                            @foreach($mechanics as $m)
                                <option value="{{ $m->id }}" {{ $a->mechanic_id == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-success">Update</button>
                        <a href="{{ url('/admin/delete-appointment/' . $a->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete appointment?')">Delete</a>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>User Issues</h4>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Problem Type</th>
                <th>Description</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($issues as $issue)
            <tr>
                <td>{{ $issue->user_name }}</td>
                <td>{{ $issue->phone }}</td>
                <td>{{ $issue->problem_type }}</td>
                <td>{{ $issue->problem_description }}</td>
                <td>{{ $issue->created_at->format('d M Y h:i A') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
