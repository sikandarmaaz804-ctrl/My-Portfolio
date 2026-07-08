<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'module',
        'description',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }

    /**
     * All permissions grouped by module, seeded on first use.
     * Add new modules here and they will appear automatically in the UI.
     */
    public static function allModules(): array
    {
        return [
            'dashboard'  => 'Dashboard',
            'blogs'      => 'Blogs',
            'projects'   => 'Projects',
            'team'       => 'Team Members',
            'contacts'   => 'Contacts / Messages',
            'resume'     => 'Resume',
            'system'     => 'System Utilities',
            'roles'      => 'Roles & Permissions',
        ];
    }

    /**
     * Actions available per module.
     * slug format: module.action
     */
    public static function seedPermissions(): void
    {
        $definitions = [
            // Dashboard
            ['module' => 'dashboard', 'slug' => 'dashboard.view',   'name' => 'View Dashboard'],

            // Blogs
            ['module' => 'blogs', 'slug' => 'blogs.view',   'name' => 'View Blogs'],
            ['module' => 'blogs', 'slug' => 'blogs.create', 'name' => 'Create Blog'],
            ['module' => 'blogs', 'slug' => 'blogs.delete', 'name' => 'Delete Blog'],

            // Projects
            ['module' => 'projects', 'slug' => 'projects.view',   'name' => 'View Projects'],
            ['module' => 'projects', 'slug' => 'projects.create', 'name' => 'Create Project'],
            ['module' => 'projects', 'slug' => 'projects.edit',   'name' => 'Edit Project'],
            ['module' => 'projects', 'slug' => 'projects.delete', 'name' => 'Delete Project'],

            // Team
            ['module' => 'team', 'slug' => 'team.view',   'name' => 'View Team Members'],
            ['module' => 'team', 'slug' => 'team.create', 'name' => 'Add Team Member'],
            ['module' => 'team', 'slug' => 'team.edit',   'name' => 'Edit Team Member'],
            ['module' => 'team', 'slug' => 'team.delete', 'name' => 'Delete Team Member'],

            // Contacts
            ['module' => 'contacts', 'slug' => 'contacts.view',    'name' => 'View Messages'],
            ['module' => 'contacts', 'slug' => 'contacts.reply',   'name' => 'Reply to Messages'],
            ['module' => 'contacts', 'slug' => 'contacts.delete',  'name' => 'Delete Messages'],
            ['module' => 'contacts', 'slug' => 'contacts.restore', 'name' => 'Restore Messages'],

            // Resume
            ['module' => 'resume', 'slug' => 'resume.view',   'name' => 'View Resume'],
            ['module' => 'resume', 'slug' => 'resume.upload', 'name' => 'Upload Resume'],
            ['module' => 'resume', 'slug' => 'resume.delete', 'name' => 'Delete Resume'],

            // System
            ['module' => 'system', 'slug' => 'system.view', 'name' => 'View System Utilities'],
            ['module' => 'system', 'slug' => 'system.run',  'name' => 'Run System Commands'],

            // Roles & Permissions
            ['module' => 'roles', 'slug' => 'roles.view',   'name' => 'View Roles'],
            ['module' => 'roles', 'slug' => 'roles.create', 'name' => 'Create Role'],
            ['module' => 'roles', 'slug' => 'roles.edit',   'name' => 'Edit Role'],
            ['module' => 'roles', 'slug' => 'roles.delete', 'name' => 'Delete Role'],
            ['module' => 'roles', 'slug' => 'roles.users',  'name' => 'Manage Role Users'],
        ];

        foreach ($definitions as $def) {
            static::firstOrCreate(
                ['slug' => $def['slug']],
                ['name' => $def['name'], 'module' => $def['module']]
            );
        }
    }
}
