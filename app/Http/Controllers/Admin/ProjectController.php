<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'client_name'  => 'required|string|max:255',
            'category'     => 'required|string|max:255',
            'website_link' => 'nullable|url|max:255',
            'image1'       => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'image2'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'image3'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'image4'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'image5'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'image6'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        $img1 = $this->uploadImage($request, 'image1', 1);
        $img2 = $this->uploadImage($request, 'image2', 2);
        $img3 = $this->uploadImage($request, 'image3', 3);
        $img4 = $this->uploadImage($request, 'image4', 4);
        $img5 = $this->uploadImage($request, 'image5', 5);
        $img6 = $this->uploadImage($request, 'image6', 6);

        Project::create([
            'title'        => $request->title,
            'client_name'  => $request->client_name,
            'category'     => $request->category,
            'website_link' => $request->filled('website_link') ? trim($request->website_link) : null,
            'image1'       => $img1,
            'image2'       => $img2,
            'image3'       => $img3,
            'image4'       => $img4,
            'image5'       => $img5,
            'image6'       => $img6,
        ]);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'client_name'  => 'required|string|max:255',
            'category'     => 'required|string|max:255',
            'website_link' => 'nullable|url|max:255',
            'image1'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'image2'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'image3'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'image4'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'image5'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'image6'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        $data = [
            'title'        => $request->title,
            'client_name'  => $request->client_name,
            'category'     => $request->category,
            'website_link' => $request->filled('website_link') ? trim($request->website_link) : null,
        ];

        if ($request->hasFile('image1')) {
            $this->deleteImage($project->image1);
            $data['image1'] = $this->uploadImage($request, 'image1', 1);
        }

        if ($request->hasFile('image2')) {
            $this->deleteImage($project->image2);
            $data['image2'] = $this->uploadImage($request, 'image2', 2);
        }

        if ($request->hasFile('image3')) {
            $this->deleteImage($project->image3);
            $data['image3'] = $this->uploadImage($request, 'image3', 3);
        }

        if ($request->hasFile('image4')) {
            $this->deleteImage($project->image4);
            $data['image4'] = $this->uploadImage($request, 'image4', 4);
        }

        if ($request->hasFile('image5')) {
            $this->deleteImage($project->image5);
            $data['image5'] = $this->uploadImage($request, 'image5', 5);
        }

        if ($request->hasFile('image6')) {
            $this->deleteImage($project->image6);
            $data['image6'] = $this->uploadImage($request, 'image6', 6);
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $this->deleteImage($project->image1);
        $this->deleteImage($project->image2);
        $this->deleteImage($project->image3);
        $this->deleteImage($project->image4);
        $this->deleteImage($project->image5);
        $this->deleteImage($project->image6);

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    // ─── Helper ──────────────────────────────────────────
    private function uploadImage(Request $request, string $fieldName, int $suffix): ?string
    {
        if (!$request->hasFile($fieldName)) {
            return null;
        }

        $uploadPath = public_path('uploads');

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true, true);
        }

        $file = $request->file($fieldName);
        $filename = time() . $suffix . '.' . $file->getClientOriginalExtension();
        $file->move($uploadPath, $filename);

        return $filename;
    }

    private function deleteImage(?string $filename): void
    {
        if ($filename) {
            $path = public_path('uploads' . DIRECTORY_SEPARATOR . $filename);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
}
