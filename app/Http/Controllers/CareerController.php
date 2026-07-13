<?php

namespace App\Http\Controllers;

use App\Models\CareerApplication;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Show the public careers / apply page.
     */
    public function index()
    {
        return view('careers');
    }

    /**
     * Store a new job application.
     * All fields are required — validated server-side.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:150',
            'email'        => 'required|email|max:200',
            'whatsapp'     => ['required', 'string', 'max:20', 'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'],
            'education'    => 'required|string|max:200',
            'expertise'    => 'required|string|max:200',
            'experience'   => 'required|string|max:2000',
            'introduction' => 'required|string|max:3000',
        ], [
            'name.required'         => 'Your full name is required.',
            'email.required'        => 'A valid email address is required.',
            'email.email'           => 'Please enter a valid email address.',
            'whatsapp.required'     => 'Your WhatsApp number is required.',
            'whatsapp.regex'        => 'Please enter a valid WhatsApp / phone number.',
            'education.required'    => 'Please enter your education background.',
            'expertise.required'    => 'Please enter your primary expertise.',
            'experience.required'   => 'Please describe your experience.',
            'introduction.required' => 'Please write a short introduction about yourself.',
        ]);

        CareerApplication::create($request->only([
            'name', 'email', 'whatsapp',
            'education', 'expertise', 'experience', 'introduction',
        ]));

        return back()->with('success', 'Your application has been submitted successfully! We will review it and get back to you via email or WhatsApp.');
    }
}
