<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * List all applications.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');

        $applications = CareerApplication::latest()
            ->when($status, fn($q) => $q->where('status', $status))
            ->get();

        $counts = [
            'all'         => CareerApplication::count(),
            'new'         => CareerApplication::where('status', 'new')->count(),
            'reviewed'    => CareerApplication::where('status', 'reviewed')->count(),
            'shortlisted' => CareerApplication::where('status', 'shortlisted')->count(),
            'rejected'    => CareerApplication::where('status', 'rejected')->count(),
        ];

        return view('admin.careers.index', compact('applications', 'counts', 'status'));
    }

    /**
     * Show a single application.
     */
    public function show(CareerApplication $career)
    {
        // Auto-mark as reviewed when opened
        if ($career->status === 'new') {
            $career->update(['status' => 'reviewed']);
        }

        return view('admin.careers.show', compact('career'));
    }

    /**
     * Update the status of an application.
     */
    public function updateStatus(Request $request, CareerApplication $career)
    {
        $request->validate([
            'status' => 'required|in:new,reviewed,shortlisted,rejected',
        ]);

        $career->update(['status' => $request->status]);

        return back()->with('success', 'Application status updated to "' . ucfirst($request->status) . '".');
    }

    /**
     * Delete a single application.
     */
    public function destroy(CareerApplication $career)
    {
        $career->delete();
        return redirect()->route('admin.careers.index')
            ->with('success', 'Application deleted successfully.');
    }

    /**
     * Delete all applications.
     */
    public function destroyAll()
    {
        CareerApplication::truncate();
        return back()->with('success', 'All applications have been deleted.');
    }
}
