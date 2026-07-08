<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    // ── List all roles ─────────────────────────────────────────────────────────
    public function index()
    {
        $roles = Role::withCount('users')->with('permissions')->latest()->get();
        return view('admin.roles.index', compact('roles'));
    }

    // ── Create form ────────────────────────────────────────────────────────────
    public function create()
    {
        // Seed permissions if the table is empty (first-time setup)
        if (Permission::count() === 0) {
            Permission::seedPermissions();
        }

        $permissionsByModule = Permission::orderBy('module')->orderBy('name')
            ->get()
            ->groupBy('module');

        $moduleLabels = Permission::allModules();

        return view('admin.roles.create', compact('permissionsByModule', 'moduleLabels'));
    }

    // ── Store new role ─────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'color'       => 'required|string|max:20',
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role = Role::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'color'       => $request->color,
        ]);

        if ($request->filled('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('admin.roles.index')
            ->with('success', "Role \"{$role->name}\" created successfully!");
    }

    // ── Edit form ──────────────────────────────────────────────────────────────
    public function edit(Role $role)
    {
        if (Permission::count() === 0) {
            Permission::seedPermissions();
        }

        $permissionsByModule = Permission::orderBy('module')->orderBy('name')
            ->get()
            ->groupBy('module');

        $moduleLabels     = Permission::allModules();
        $assignedIds      = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissionsByModule', 'moduleLabels', 'assignedIds'));
    }

    // ── Update role ────────────────────────────────────────────────────────────
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'color'       => 'required|string|max:20',
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'color'       => $request->color,
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('admin.roles.index')
            ->with('success', "Role \"{$role->name}\" updated successfully!");
    }

    // ── Delete role ────────────────────────────────────────────────────────────
    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return back()->with('error', "Cannot delete \"{$role->name}\" — it has active users assigned. Reassign or remove them first.");
        }

        $name = $role->name;
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', "Role \"{$name}\" deleted.");
    }

    // ── Seed permissions (utility) ─────────────────────────────────────────────
    public function seedPermissions()
    {
        Permission::seedPermissions();
        return back()->with('success', 'Permissions have been seeded/refreshed.');
    }
}
