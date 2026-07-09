<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Allow access if either the main admin OR a role_user is logged in.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        if (Auth::guard('role_user')->check()) {
            $roleUser = Auth::guard('role_user')->user();

            if (!$roleUser->is_active) {
                Auth::guard('role_user')->logout();

                return redirect()->route('admin.login')
                    ->with('error', 'Your account has been deactivated. Contact the administrator.');
            }

            return $next($request);
        }

        return redirect()->route('admin.login');
    }
}
