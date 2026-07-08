<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleUser extends Authenticatable
{
    protected $table = 'role_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active'     => 'boolean',
        'last_login_at' => 'datetime',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if this user has a specific permission slug.
     */
    public function hasPermission(string $slug): bool
    {
        return $this->role
            && $this->role->permissions->contains('slug', $slug);
    }

    /**
     * Eager-load role + permissions in one shot.
     */
    public function loadRolePermissions(): self
    {
        return $this->load('role.permissions');
    }
}
