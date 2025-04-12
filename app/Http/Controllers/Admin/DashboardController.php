<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'mechanic_id' => 'required|exists:mechanics,id',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->only('appointment_date', 'mechanic_id'));

        return back()->with('success', 'Appointment updated.');
    }

    public function delete($id)
    {
        Appointment::destroy($id);
        return back()->with('success', 'Appointment deleted.');
    }
}
