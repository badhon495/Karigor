<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Admin::create($request->only(['name', 'email', 'password']));

        return back()->with('success', 'Admin added successfully');
    }

    public function destroy($id)
    {
        // Prevent deleting yourself
        $currentAdminEmail = session('admin_email');
        $admin = Admin::find($id);
        
        if ($admin && $admin->email === $currentAdminEmail) {
            return back()->with('error', 'You cannot delete your own admin account');
        }
        
        Admin::destroy($id);
        return back()->with('success', 'Admin deleted successfully');
    }
}