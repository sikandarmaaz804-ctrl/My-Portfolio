<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * Usage in route: ->middleware('permission:contacts.view')
     *
     * The main admin (guard 'admin') bypasses all permission checks.
     * Sub-admins (guard 'role_user') must have the given permission.
     */
    public function handle(Request $request, Closure $next, string $permission): mixed
    {
        // Main admin — full access, no restriction
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // Sub-admin guard
        $roleUser = Auth::guard('role_user')->user();

        if (!$roleUser) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to continue.');
        }

        if (!$roleUser->is_active) {
            Auth::guard('role_user')->logout();
            return redirect()->route('admin.login')
                ->with('error', 'Your account has been deactivated. Contact the administrator.');
        }

        // Load role + permissions (cached per request)
        $roleUser->loadMissing('role.permissions');

        if (!$roleUser->hasPermission($permission)) {
            abort(403, 'You do not have permission to perform this action.');
        }

        return $next($request);
    }
}
