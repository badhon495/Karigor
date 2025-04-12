@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Contact Admin</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="/contact-admin" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Your Name</label>
                        <input type="text" name="user_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Problem Type</label>
                    <select name="problem_type" class="form-control" required>
                        <option value="">-- Select Problem Type --</option>
                        <option value="Appointment Issue">Appointment Issue</option>
                        <option value="Mechanic Complaint">Mechanic Complaint</option>
                        <option value="Service Quality">Service Quality</option>
                        <option value="Billing Problem">Billing Problem</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Problem Description</label>
                    <textarea name="problem_description" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- Success Popup Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-check-circle text-success mb-3" style="font-size: 3rem;"></i>
                <h4 id="successMessage">{{ session('success_popup') }}</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Continue</button>
                <a href="/" class="btn btn-outline-secondary">Go to Home</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show success modal if session has success_popup message
        @if(session('success_popup'))
            $('#successModal').modal('show');
        @endif
    });
</script>
@endsection