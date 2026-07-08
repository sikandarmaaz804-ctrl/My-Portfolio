<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactConfirmationMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9\s\-\+\(\)]+$/',
            'subject' => 'required',
            'message' => 'required',
        ], [
            'phone.regex' => 'Please enter a valid phone number.',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Send confirmation email to user immediately (not queued)
        try {
            Mail::send(new ContactConfirmationMail($contact));
        } catch (\Exception $e) {
            // Log error but don't prevent form submission
            \Log::error('Contact confirmation email failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Message sent successfully! Please check your email for confirmation.');
    }
}