<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Best Car Workshop in the Town</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center mt-5">
        <h1 class="mb-4">🚗 Best Car Workshop in the Town 🚗</h1>

        <div class="d-grid gap-3 col-6 mx-auto">
            <a href="{{ url('/book-appointment') }}" class="btn btn-primary btn-lg">Book an Appointment</a>
            <a href="{{ url('/track') }}" class="btn btn-success btn-lg">Track Appointment</a>
        </div>
    </div>
</body>
</html>
