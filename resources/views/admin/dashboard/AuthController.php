use App\Models\Appointment;
use App\Models\ContactIssue;
use App\Models\Mechanic;

public function dashboard()
{
    $appointments = Appointment::with('mechanic')->orderBy('appointment_date', 'desc')->get();
    $issues = ContactIssue::orderBy('created_at', 'desc')->get();
    $mechanics = Mechanic::all();

    return view('admin.dashboard', compact('appointments', 'issues', 'mechanics'));
}
