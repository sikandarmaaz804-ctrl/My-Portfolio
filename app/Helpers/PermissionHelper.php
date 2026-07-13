<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class PermissionHelper
{
    private const ADMIN_LANDING_ROUTES = [
        'dashboard.view' => 'admin.dashboard',
        'blogs.view' => 'admin.blogs',
        'blogs.create' => 'admin.blog',
        'projects.view' => 'admin.projects.index',
        'projects.create' => 'admin.projects.create',
        'team.view' => 'admin.team.index',
        'team.create' => 'admin.team.create',
        'contacts.view' => 'admin.contacts.index',
        'careers.view' => 'admin.careers.index',
        'resume.view' => 'admin.resume',
        'system.view' => 'admin.system',
        'roles.view' => 'admin.roles.index',
        'roles.users' => 'admin.role-users.index',
    ];

    /**
     * Check if the current authenticated user has a specific permission.
     * Main admin (guard 'admin') always returns true.
     * Role users (guard 'role_user') check against their role's permissions.
     */
    public static function can(string $permissionSlug): bool
    {
        // Main admin — full access
        if (Auth::guard('admin')->check()) {
            return true;
        }

        // Role user — check permissions
        $roleUser = Auth::guard('role_user')->user();
        if ($roleUser) {
            return $roleUser->hasPermission($permissionSlug);
        }

        return false;
    }

    /**
     * Get the currently authenticated user (admin or role_user).
     */
    public static function user()
    {
        if (Auth::guard('admin')->check()) {
            return Auth::guard('admin')->user();
        }

        if (Auth::guard('role_user')->check()) {
            return Auth::guard('role_user')->user();
        }

        return null;
    }

    /**
     * Return the first admin route the current user can access.
     */
    public static function firstAllowedAdminRoute(): string
    {
        if (Auth::guard('admin')->check()) {
            return 'admin.dashboard';
        }

        foreach (self::ADMIN_LANDING_ROUTES as $permission => $route) {
            if (self::can($permission)) {
                return $route;
            }
        }

        return 'admin.no-access';
    }

    /**
     * Check if the current user is the main admin.
     */
    public static function isSuperAdmin(): bool
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the role name for display purposes.
     */
    public static function getRoleName(): string
    {
        if (Auth::guard('admin')->check()) {
            return 'Super Administrator';
        }

        $roleUser = Auth::guard('role_user')->user();
        if ($roleUser && $roleUser->role) {
            return $roleUser->role->name;
        }

        return 'Guest';
    }

    /**
     * Get the user's display name.
     */
    public static function getUserName(): string
    {
        $user = self::user();
        return $user ? $user->name : 'Guest';
    }

    /**
     * Get the role color for badges (defaults to accent if super admin).
     */
    public static function getRoleColor(): string
    {
        if (Auth::guard('admin')->check()) {
            return '#6366f1'; // accent color
        }

        $roleUser = Auth::guard('role_user')->user();
        if ($roleUser && $roleUser->role) {
            return $roleUser->role->color;
        }

        return '#64748b'; // text-muted
    }
}
