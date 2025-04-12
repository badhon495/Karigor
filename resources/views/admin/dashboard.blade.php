@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <form action="{{ route('admin.logout') }}" method="POST">@csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>

    <!-- Tabs for better organization -->
    <ul class="nav nav-tabs mb-4" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="appointments-tab" data-toggle="tab" data-target="#appointments" type="button" role="tab" aria-controls="appointments" aria-selected="true">Appointments</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="issues-tab" data-toggle="tab" data-target="#issues" type="button" role="tab" aria-controls="issues" aria-selected="false">User Issues</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="add-mechanic-tab" data-toggle="tab" data-target="#add-mechanic" type="button" role="tab" aria-controls="add-mechanic" aria-selected="false">Add Mechanic</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="add-admin-tab" data-toggle="tab" data-target="#add-admin" type="button" role="tab" aria-controls="add-admin" aria-selected="false">Add Admin</button>
        </li>
    </ul>

    <div class="tab-content" id="adminTabsContent">
        <!-- Appointments Tab -->
        <div class="tab-pane fade show active" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
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
        </div>

        <!-- User Issues Tab -->
        <div class="tab-pane fade" id="issues" role="tabpanel" aria-labelledby="issues-tab">
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

        <!-- Add Mechanic Tab -->
        <div class="tab-pane fade" id="add-mechanic" role="tabpanel" aria-labelledby="add-mechanic-tab">
            <div class="row">
                <div class="col-md-6">
                    <h4>Add New Mechanic</h4>
                    <form method="POST" action="{{ url('/admin/add-mechanic') }}">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Specialty</label>
                            <input type="text" name="specialty" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Experience (years)</label>
                            <input type="number" name="experience" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Mechanic</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h4>Current Mechanics</h4>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Specialty</th>
                                <th>Experience</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mechanics as $mechanic)
                            <tr>
                                <td>{{ $mechanic->name }}</td>
                                <td>{{ $mechanic->specialty ?? 'N/A' }}</td>
                                <td>{{ $mechanic->experience ?? 'N/A' }} years</td>
                                <td>
                                    <a href="{{ url('/admin/delete-mechanic/' . $mechanic->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this mechanic?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Admin Tab -->
        <div class="tab-pane fade" id="add-admin" role="tabpanel" aria-labelledby="add-admin-tab">
            <div class="row">
                <div class="col-md-6">
                    <h4>Add New Admin</h4>
                    <form method="POST" action="{{ url('/admin/add-admin') }}">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Admin</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h4>Current Admins</h4>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins ?? [] as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    <a href="{{ url('/admin/delete-admin/' . $admin->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this admin?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
