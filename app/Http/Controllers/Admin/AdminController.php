<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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