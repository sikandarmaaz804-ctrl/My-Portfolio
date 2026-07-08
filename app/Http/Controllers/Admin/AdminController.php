<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function system()
    {
        return view('admin.system');
    }

    // ─── RESUME ──────────────────────────────────────────────────────────

    public function resumeForm()
    {
        $resume = Setting::get('resume');
        return view('admin.resume', compact('resume'));
    }

    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf|max:10240',
        ]);

        $uploadPath = base_path('uploads');

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true, true);
        }

        // Delete the old resume file if it exists
        $oldResume = Setting::get('resume');
        if ($oldResume) {
            $oldPath = $uploadPath . DIRECTORY_SEPARATOR . $oldResume;
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $file     = $request->file('resume');
        $filename = 'resume_' . time() . '.pdf';
        $file->move($uploadPath, $filename);

        Setting::set('resume', $filename);

        return redirect()->route('admin.resume')
            ->with('success', 'Resume uploaded successfully!');
    }

    public function deleteResume()
    {
        $filename = Setting::get('resume');

        if ($filename) {
            $path = base_path('uploads') . DIRECTORY_SEPARATOR . $filename;
            if (File::exists($path)) {
                File::delete($path);
            }
            Setting::set('resume', null);
        }

        return redirect()->route('admin.resume')
            ->with('success', 'Resume deleted successfully.');
    }

    public function runCommand(Request $request)
    {
        $request->validate([
            'command' => 'required|string|in:storage_link,migrate,clear_cache,optimize'
        ]);

        $command = $request->command;
        $output = '';

        try {
            switch ($command) {
                case 'storage_link':
                    $publicStoragePath = public_path('storage');
                    if (file_exists($publicStoragePath) || is_link($publicStoragePath)) {
                        if (is_link($publicStoragePath)) {
                            // On Windows, directory symlinks/junctions return true for is_link(), but unlink() fails.
                            if (is_dir($publicStoragePath)) {
                                rmdir($publicStoragePath);
                            } else {
                                unlink($publicStoragePath);
                            }
                        } elseif (is_dir($publicStoragePath)) {
                            // First try rmdir() in case it is a junction/symlink directory not caught by is_link()
                            if (!@rmdir($publicStoragePath)) {
                                \Illuminate\Support\Facades\File::deleteDirectory($publicStoragePath);
                            }
                        } else {
                            unlink($publicStoragePath);
                        }
                    }
                    
                    \Illuminate\Support\Facades\Artisan::call('storage:link');
                    $output = \Illuminate\Support\Facades\Artisan::output();
                    $message = 'Storage link created successfully!';
                    break;

                case 'migrate':
                    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                    $output = \Illuminate\Support\Facades\Artisan::output();
                    $message = 'Database migrations executed successfully!';
                    break;

                case 'clear_cache':
                    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
                    $output = \Illuminate\Support\Facades\Artisan::output();
                    $message = 'Caches cleared successfully!';
                    break;

                case 'optimize':
                    \Illuminate\Support\Facades\Artisan::call('config:cache');
                    \Illuminate\Support\Facades\Artisan::call('route:cache');
                    \Illuminate\Support\Facades\Artisan::call('view:cache');
                    $output = "Caches created successfully!\n" . \Illuminate\Support\Facades\Artisan::output();
                    $message = 'Project optimized successfully!';
                    break;
            }

            return redirect()->back()->with('success', $message)->with('command_output', $output);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error executing command: ' . $e->getMessage());
        }
    }
}