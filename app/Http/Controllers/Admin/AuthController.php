<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Appointment;
use App\Models\ContactIssue;
use App\Models\Mechanic;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Hardcoded credentials for demo (you can migrate this to a database later)
        if ($request->email === 'admin@gmail.com' && $request->password === 'admin123') {
            Session::put('is_admin', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['Invalid credentials.']);
    }

    public function logout()
    {
        Session::forget('is_admin');
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $appointments = Appointment::with('mechanic')->orderBy('appointment_date', 'desc')->get();
        $issues = ContactIssue::orderBy('created_at', 'desc')->get();
        $mechanics = Mechanic::all();

        return view('admin.dashboard', compact('appointments', 'issues', 'mechanics'));
    }
}
