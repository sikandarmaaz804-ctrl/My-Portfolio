<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Mail\ContactReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // ── Inbox ──────────────────────────────────────────────────────────────────
    public function index()
    {
        // Auto-purge trashed messages older than 5 days on every inbox visit
        Contact::purgeOldTrashed();

        $contacts     = Contact::latest()->get();
        $trashedCount = Contact::onlyTrashed()->count();

        return view('admin.contacts.index', compact('contacts', 'trashedCount'));
    }

    // ── Show single message ────────────────────────────────────────────────────
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    // ── Reply ─────────────────────────────────────────────────────────────────
    public function reply(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $contact = Contact::findOrFail($id);

        // Send reply using Laravel Mailable (better for deliverability)
        Mail::send(new ContactReplyMail(
            contact: $contact,
            subject: $request->subject,
            message: $request->message,
        ));

        return back()->with('success', 'Reply sent successfully!');
    }

    // ── Soft-delete a single message ──────────────────────────────────────────
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete(); // soft delete → goes to trash

        return back()->with('deleted', 'Message moved to trash. It will be permanently deleted after 5 days.');
    }

    // ── Soft-delete ALL messages ───────────────────────────────────────────────
    public function deleteAll()
    {
        Contact::whereNull('deleted_at')->delete();

        return back()->with('deleted', 'All messages moved to trash. They will be permanently deleted after 5 days.');
    }

    // ── Trash view ────────────────────────────────────────────────────────────
    public function trash()
    {
        Contact::purgeOldTrashed();

        $trashed = Contact::onlyTrashed()->latest('deleted_at')->get();
        return view('admin.contacts.trash', compact('trashed'));
    }

    // ── Restore a single trashed message ─────────────────────────────────────
    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();

        return back()->with('success', 'Message restored to inbox.');
    }

    // ── Restore ALL trashed messages ──────────────────────────────────────────
    public function restoreAll()
    {
        Contact::onlyTrashed()->restore();

        return back()->with('success', 'All trashed messages have been restored.');
    }

    // ── Permanently delete a single message from trash ────────────────────────
    public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();

        return back()->with('success', 'Message permanently deleted.');
    }
}
