<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mechanic;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function create()
    {
        // Get mechanics with available slots
        $today = now()->toDateString();

$mechanics = Mechanic::all()->map(function (Mechanic $m) use ($today): Mechanic {
    $count = Appointment::where('mechanic_id', $m->id)
        ->whereDate('appointment_date', $today)
        ->count();

    $m->slots_left = max(0, 4 - $count);

    // Assign slot times
    $slotTimes = [
        '8:00 – 10:00 AM',
        '10:00 – 12:00 PM',
        '1:00 – 3:00 PM',
        '3:00 – 5:00 PM'
    ];

    $m->next_slot_time = $count < 4 ? $slotTimes[$count] : null;

    return $m;
});

        

        return view('appointment.create', compact('mechanics'));
    }

    public function availableMechanics(Request $request)
    {
        $selectedDate = $request->query('date', now()->toDateString());
    
        $mechanics = Mechanic::all()->map(function ($m) use ($selectedDate) {
            $appointments = Appointment::where('mechanic_id', $m->id)
                ->whereDate('appointment_date', $selectedDate)
                ->get();
    
            $slotTimes = [
                '8:00 – 10:00 AM',
                '10:00 – 12:00 PM',
                '1:00 – 3:00 PM',
                '3:00 – 5:00 PM'
            ];
    
            $count = $appointments->count();
    
            return [
                'id' => $m->id,
                'name' => $m->name,
                'slots_left' => max(0, 4 - $count),
                'next_slot_time' => $count < 4 ? $slotTimes[$count] : null
            ];
        });
    
        return response()->json($mechanics);
    }
    



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'car_license' => 'required',
            'car_engine' => 'required|numeric',
            'appointment_date' => 'required|date',
            'mechanic_id' => 'required|exists:mechanics,id',
        ]);

        $selectedDate = $validated['appointment_date']; // Use the selected date from the request

        // Check for duplicate booking
        $existing = Appointment::whereDate('appointment_date', $selectedDate)
            ->where(function ($q) use ($validated) {
                $q->where('phone', $validated['phone'])
                  ->orWhere('name', $validated['name'])
                  ->orWhere('car_engine', $validated['car_engine']);
            })->exists();

        if ($existing) {
            return back()->withErrors(['duplicate' => 'You already have an appointment on this date or with the same car.']);
        }

        // Count how many appointments the mechanic already has for that day
        $count = Appointment::where('mechanic_id', $validated['mechanic_id'])
            ->whereDate('appointment_date', $selectedDate)
            ->count();

        if ($count >= 4) {
            return back()->withErrors(['mechanic_full' => 'This mechanic is fully booked for that day.']);
        }

        $slotTimes = [
            '8:00 – 10:00 AM',
            '10:00 – 12:00 PM',
            '1:00 – 3:00 PM',
            '3:00 – 5:00 PM'
        ];

        $validated['time_slot'] = $slotTimes[$count]; // Assign next slot

        Appointment::create($validated);

        // Recalculate slots for all mechanics
        Mechanic::all()->each(function ($m) use ($selectedDate) {
            $count = Appointment::where('mechanic_id', $m->id)
                ->whereDate('appointment_date', $selectedDate)
                ->count();

            $m->slots_left = max(0, 4 - $count);

            $slotTimes = [
                '8:00 – 10:00 AM',
                '10:00 – 12:00 PM',
                '1:00 – 3:00 PM',
                '3:00 – 5:00 PM'
            ];

            $m->next_slot_time = $count < 4 ? $slotTimes[$count] : null;
        });

        return redirect('/')->with('success', 'Appointment successfully booked!');
    }
}