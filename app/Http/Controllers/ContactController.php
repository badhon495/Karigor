<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactIssue;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required',
            'phone' => 'required',
            'problem_type' => 'required',
            'problem_description' => 'required',
        ]);

        // Directly create using request data since the field names now match
        ContactIssue::create($validated);

        return redirect('/')->with('success', 'Your issue has been submitted. Admin will contact you soon.');
    }
}
