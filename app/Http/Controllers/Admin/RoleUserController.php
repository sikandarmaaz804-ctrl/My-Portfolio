<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoleUserController extends Controller
{
    // ── List all role-based users ──────────────────────────────────────────────
    public function index()
    {
        $users = RoleUser::with('role')->latest()->get();
        return view('admin.roles.users.index', compact('users'));
    }

    // ── Create form ────────────────────────────────────────────────────────────
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.roles.users.create', compact('roles'));
    }

    // ── Store new user ─────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:150',
            'email'    => 'required|email|unique:role_users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id'  => 'required|exists:roles,id',
        ]);

        RoleUser::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role_id'   => $request->role_id,
            'is_active' => true,
        ]);

        return redirect()->route('admin.role-users.index')
            ->with('success', "User \"{$request->name}\" created successfully!");
    }

    // ── Edit form ──────────────────────────────────────────────────────────────
    public function edit(RoleUser $roleUser)
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.roles.users.edit', compact('roleUser', 'roles'));
    }

    // ── Update user ────────────────────────────────────────────────────────────
    public function update(Request $request, RoleUser $roleUser)
    {
        $request->validate([
            'name'     => 'required|string|max:150',
            'email'    => 'required|email|unique:role_users,email,' . $roleUser->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id'  => 'required|exists:roles,id',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'role_id'   => $request->role_id,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $roleUser->update($data);

        return redirect()->route('admin.role-users.index')
            ->with('success', "User \"{$roleUser->name}\" updated successfully!");
    }

    // ── Toggle active/inactive ─────────────────────────────────────────────────
    public function toggleStatus(RoleUser $roleUser)
    {
        $roleUser->update(['is_active' => !$roleUser->is_active]);

        $status = $roleUser->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "User \"{$roleUser->name}\" has been {$status}.");
    }

    // ── Delete user ────────────────────────────────────────────────────────────
    public function destroy(RoleUser $roleUser)
    {
        $name = $roleUser->name;
        $roleUser->delete();

        return redirect()->route('admin.role-users.index')
            ->with('success', "User \"{$name}\" removed successfully.");
    }
}
