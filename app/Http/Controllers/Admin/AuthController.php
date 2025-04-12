<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Appointment;
use App\Models\ContactIssue;
use App\Models\Mechanic;
use App\Models\Admin;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;

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

        // First, check for hardcoded credentials
        if ($request->email === 'admin@gmail.com' && $request->password === 'admin123') {
            Session::put('is_admin', true);
            Session::put('admin_email', 'admin@gmail.com');
            return redirect()->route('admin.dashboard');
        }

        // Only check database if the table exists
        if (Schema::hasTable('admins')) {
            try {
                // Check database for admin credentials
                $admin = Admin::where('email', $request->email)->first();
                
                // If admin exists, validate password
                if ($admin && password_verify($request->password, $admin->password)) {
                    Session::put('is_admin', true);
                    Session::put('admin_email', $admin->email);
                    return redirect()->route('admin.dashboard');
                }
            } catch (QueryException $e) {
                // If there's a database error, fall back to default behavior
            }
        }

        return back()->withErrors(['Invalid credentials.']);
    }

    public function logout()
    {
        Session::forget('is_admin');
        Session::forget('admin_email');
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $appointments = Appointment::with('mechanic')->orderBy('appointment_date', 'desc')->get();
        $issues = ContactIssue::orderBy('created_at', 'desc')->get();
        $mechanics = Mechanic::all();
        
        // Only try to fetch admins if the table exists
        $admins = [];
        if (Schema::hasTable('admins')) {
            try {
                $admins = Admin::all();
            } catch (QueryException $e) {
                // If there's an error, just leave $admins as an empty array
            }
        }

        return view('admin.dashboard', compact('appointments', 'issues', 'mechanics', 'admins'));
    }
}
