<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Try main admin guard first
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        // Try role_user guard (sub-admins)
        if (Auth::guard('role_user')->attempt($credentials)) {
            $user = Auth::guard('role_user')->user();

            if (!$user->is_active) {
                Auth::guard('role_user')->logout();
                return back()->with('error', 'Your account is inactive. Contact the administrator.');
            }

            // Track last login
            $user->update(['last_login_at' => now()]);

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Auth::guard('role_user')->logout();
        return redirect()->route('admin.login');
    }
}
