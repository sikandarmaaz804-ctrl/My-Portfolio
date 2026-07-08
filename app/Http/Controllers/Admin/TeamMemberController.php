<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'position'         => 'required|string|max:255',
            'expertise'        => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0|max:99',
            'description'      => 'required|string|max:1000',
            'photo'            => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'       => 'nullable|integer|min:0',
        ]);

        $photo = $this->uploadPhoto($request);

        TeamMember::create([
            'name'             => $request->name,
            'position'         => $request->position,
            'expertise'        => $request->expertise,
            'experience_years' => $request->experience_years,
            'description'      => $request->description,
            'photo'            => $photo,
            'sort_order'       => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member added successfully!');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'position'         => 'required|string|max:255',
            'expertise'        => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0|max:99',
            'description'      => 'required|string|max:1000',
            'photo'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'       => 'nullable|integer|min:0',
        ]);

        $data = [
            'name'             => $request->name,
            'position'         => $request->position,
            'expertise'        => $request->expertise,
            'experience_years' => $request->experience_years,
            'description'      => $request->description,
            'sort_order'       => $request->sort_order ?? 0,
        ];

        if ($request->hasFile('photo')) {
            $this->deletePhoto($team->photo);
            $data['photo'] = $this->uploadPhoto($request);
        }

        $team->update($data);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member updated successfully!');
    }

    public function destroy(TeamMember $team)
    {
        $this->deletePhoto($team->photo);
        $team->delete();

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member removed successfully!');
    }

    // ─── Helpers ──────────────────────────────────────────
    private function uploadPhoto(Request $request): string
    {
        $uploadPath = base_path('uploads');

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true, true);
        }

        $file     = $request->file('photo');
        $filename = 'team_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($uploadPath, $filename);

        return $filename;
    }

    private function deletePhoto(?string $filename): void
    {
        if ($filename) {
            $path = base_path('uploads' . DIRECTORY_SEPARATOR . $filename);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
}
