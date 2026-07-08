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
        if (Auth::guard('admin')->check() || Auth::guard('role_user')->check()) {
            return $next($request);
        }

        return redirect()->route('admin.login');
    }
}
