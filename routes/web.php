<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Helpers\PermissionHelper;
use App\Models\Project;

use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\TeamMemberController as AdminTeamController;
use App\Http\Controllers\Admin\CareerController as AdminCareerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;

/*
|--------------------------------------------------------------------------
| HOME PAGE
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $projects = Project::latest()->get();
    return view('index', compact('projects'));
})->name('home');

/*
|--------------------------------------------------------------------------
| PORTFOLIO PAGE
|--------------------------------------------------------------------------
*/
Route::get('/portfolio', function () {
    $projects = Project::latest()->get();

    // Map stored category slugs to human-readable labels
    $categoryLabels = [
        'manipul'  => 'Web Development',
        'creative' => 'UI/UX Design',
        'brand'    => 'Branding',
        'mobile'   => 'Mobile Applications',
        'desktop'  => 'Desktop Applications',
    ];

    // Only include categories that actually exist in the DB
    $categories = $projects
        ->pluck('category')
        ->unique()
        ->filter()
        ->map(fn($slug) => [
            'slug'  => $slug,
            'label' => $categoryLabels[$slug] ?? ucfirst($slug),
        ])
        ->values();

    return view('portfolio', compact('projects', 'categories'));
})->name('portfolio');

/*
|--------------------------------------------------------------------------
| CONTACT (USER SIDE)
|--------------------------------------------------------------------------
*/
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

/*
|--------------------------------------------------------------------------
| CAREERS (USER SIDE)
|--------------------------------------------------------------------------
*/
Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::post('/careers', [CareerController::class, 'store'])->name('careers.store');

/*
|--------------------------------------------------------------------------
| ABOUT
|--------------------------------------------------------------------------
*/
Route::get('/about-us', function () {
    $resume  = \App\Models\Setting::get('resume');
    $members = \App\Models\TeamMember::orderBy('sort_order')->orderBy('id')->take(6)->get();
    return view('about-us', compact('resume', 'members'));
})->name('about-us');

/*
|--------------------------------------------------------------------------
| OUR TEAM
|--------------------------------------------------------------------------
*/
Route::get('/our-team', function () {
    $members = \App\Models\TeamMember::orderBy('sort_order')->orderBy('id')->get();
    return view('team', compact('members'));
})->name('team');

/*
|--------------------------------------------------------------------------
| RESUME DOWNLOAD (public)
|--------------------------------------------------------------------------
*/
Route::get('/resume/download', function () {
    $filename = \App\Models\Setting::get('resume');

    if (!$filename) {
        abort(404, 'Resume not available.');
    }

    $path = base_path('uploads' . DIRECTORY_SEPARATOR . $filename);

    if (!\Illuminate\Support\Facades\File::exists($path)) {
        abort(404, 'Resume file not found.');
    }

    return response()->download($path, 'Maaz_Sikandar_Resume.pdf', [
        'Content-Type'        => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="Maaz_Sikandar_Resume.pdf"',
    ]);
})->name('resume.download');

/*
|--------------------------------------------------------------------------
| SERVICES
|--------------------------------------------------------------------------
*/
Route::get('/services', function () {
    return view('services');
})->name('services');

/*
|--------------------------------------------------------------------------
| BLOG (USER SIDE)
|--------------------------------------------------------------------------
*/
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::get('/blog/{id}/popup', [BlogController::class, 'popup'])
    ->name('blog.popup');

Route::post('/blog/{id}/comment', [BlogController::class, 'storeComment'])
    ->name('blog.comment');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (PROTECTED)
|--------------------------------------------------------------------------
*/
Route::middleware('admin.auth')->prefix('admin')->group(function () {

    Route::get('/', function () {
        return redirect()->route(PermissionHelper::firstAllowedAdminRoute());
    })->name('admin.home');

    Route::get('/no-access', function () {
        return view('admin.no-access');
    })->name('admin.no-access');

    // DASHBOARD
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROJECTS (ADMIN FULL CRUD ✅)
    |--------------------------------------------------------------------------
    */
    Route::get('/projects', [AdminProjectController::class, 'index'])
        ->name('admin.projects.index')->middleware('permission:projects.view');
    Route::get('/projects/create', [AdminProjectController::class, 'create'])
        ->name('admin.projects.create')->middleware('permission:projects.create');
    Route::post('/projects', [AdminProjectController::class, 'store'])
        ->name('admin.projects.store')->middleware('permission:projects.create');
    Route::get('/projects/{project}/edit', [AdminProjectController::class, 'edit'])
        ->name('admin.projects.edit')->middleware('permission:projects.edit');
    Route::put('/projects/{project}', [AdminProjectController::class, 'update'])
        ->name('admin.projects.update')->middleware('permission:projects.edit');
    Route::delete('/projects/{project}', [AdminProjectController::class, 'destroy'])
        ->name('admin.projects.destroy')->middleware('permission:projects.delete');

    /*
    |--------------------------------------------------------------------------
    | TEAM MEMBERS (ADMIN FULL CRUD ✅)
    |--------------------------------------------------------------------------
    */
    Route::get('/team', [AdminTeamController::class, 'index'])
        ->name('admin.team.index')->middleware('permission:team.view');
    Route::get('/team/create', [AdminTeamController::class, 'create'])
        ->name('admin.team.create')->middleware('permission:team.create');
    Route::post('/team', [AdminTeamController::class, 'store'])
        ->name('admin.team.store')->middleware('permission:team.create');
    Route::get('/team/{team}/edit', [AdminTeamController::class, 'edit'])
        ->name('admin.team.edit')->middleware('permission:team.edit');
    Route::put('/team/{team}', [AdminTeamController::class, 'update'])
        ->name('admin.team.update')->middleware('permission:team.edit');
    Route::delete('/team/{team}', [AdminTeamController::class, 'destroy'])
        ->name('admin.team.destroy')->middleware('permission:team.delete');

    /*
    |--------------------------------------------------------------------------
    | BLOG ADMIN
    |--------------------------------------------------------------------------
    */
    Route::get('/blogs', [BlogController::class, 'adminIndex'])
        ->name('admin.blogs')->middleware('permission:blogs.view,blogs.create');

    Route::get('/blog', function () {
        return view('admin.add-blog');
    })->name('admin.blog')->middleware('permission:blogs.create');

    Route::post('/blog/store', [BlogController::class, 'store'])
        ->name('admin.blog.store')->middleware('permission:blogs.create');

    Route::delete('/blog/{id}', [BlogController::class, 'destroy'])
        ->name('admin.blog.delete')->middleware('permission:blogs.delete');

    Route::get('/uploads', [BlogController::class, 'uploads'])
        ->name('admin.uploads')->middleware('permission:blogs.view,blogs.create');

    /*
    |--------------------------------------------------------------------------
    | CONTACTS
    |--------------------------------------------------------------------------
    */
    Route::get('/contacts', [AdminContactController::class, 'index'])
        ->name('admin.contacts.index')->middleware('permission:contacts.view');
    Route::get('/contacts/trash', [AdminContactController::class, 'trash'])
        ->name('admin.contacts.trash')->middleware('permission:contacts.view');
    Route::get('/contacts/{id}', [AdminContactController::class, 'show'])
        ->name('admin.contacts.show')->middleware('permission:contacts.view');

    Route::post('/contacts/{id}/reply', [AdminContactController::class, 'reply'])
        ->name('admin.contacts.reply')->middleware('permission:contacts.reply');

    Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])
        ->name('admin.contacts.destroy')->middleware('permission:contacts.delete');
    Route::delete('/contacts-delete-all', [AdminContactController::class, 'deleteAll'])
        ->name('admin.contacts.deleteAll')->middleware('permission:contacts.delete');

    Route::post('/contacts/{id}/restore', [AdminContactController::class, 'restore'])
        ->name('admin.contacts.restore')->middleware('permission:contacts.restore');
    Route::post('/contacts-restore-all', [AdminContactController::class, 'restoreAll'])
        ->name('admin.contacts.restoreAll')->middleware('permission:contacts.restore');
    Route::delete('/contacts/{id}/force-delete', [AdminContactController::class, 'forceDelete'])
        ->name('admin.contacts.forceDelete')->middleware('permission:contacts.delete');

    Route::get('/messages', [AdminContactController::class, 'index'])
        ->name('admin.messages')->middleware('permission:contacts.view');

    /*
    |--------------------------------------------------------------------------
    | CAREER APPLICATIONS (ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::get('/careers', [AdminCareerController::class, 'index'])
        ->name('admin.careers.index')->middleware('permission:careers.view');
    Route::get('/careers/{career}', [AdminCareerController::class, 'show'])
        ->name('admin.careers.show')->middleware('permission:careers.view');
    Route::patch('/careers/{career}/status', [AdminCareerController::class, 'updateStatus'])
        ->name('admin.careers.status')->middleware('permission:careers.status');
    Route::delete('/careers/{career}', [AdminCareerController::class, 'destroy'])
        ->name('admin.careers.destroy')->middleware('permission:careers.delete');
    Route::delete('/careers-delete-all', [AdminCareerController::class, 'destroyAll'])
        ->name('admin.careers.destroyAll')->middleware('permission:careers.delete');

    // System Utilities
    Route::get('/system', [AdminController::class, 'system'])
        ->name('admin.system')->middleware('permission:system.view');
    Route::post('/system/run-command', [AdminController::class, 'runCommand'])
        ->name('admin.system.run_command')->middleware('permission:system.run');

    // Resume
    Route::get('/resume', [AdminController::class, 'resumeForm'])
        ->name('admin.resume')->middleware('permission:resume.view');
    Route::post('/resume', [AdminController::class, 'uploadResume'])
        ->name('admin.resume.upload')->middleware('permission:resume.upload');
    Route::delete('/resume', [AdminController::class, 'deleteResume'])
        ->name('admin.resume.delete')->middleware('permission:resume.delete');

    /*
    |--------------------------------------------------------------------------
    | ROLES & PERMISSIONS (main admin only)
    |--------------------------------------------------------------------------
    */
    Route::get('/roles', [RoleController::class, 'index'])
        ->name('admin.roles.index')->middleware('permission:roles.view');
    Route::get('/roles/create', [RoleController::class, 'create'])
        ->name('admin.roles.create')->middleware('permission:roles.create');
    Route::post('/roles', [RoleController::class, 'store'])
        ->name('admin.roles.store')->middleware('permission:roles.create');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
        ->name('admin.roles.edit')->middleware('permission:roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])
        ->name('admin.roles.update')->middleware('permission:roles.edit');
    Route::patch('/roles/{role}', [RoleController::class, 'update'])
        ->name('admin.roles.update.patch')->middleware('permission:roles.edit');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
        ->name('admin.roles.destroy')->middleware('permission:roles.delete');

    Route::post('/roles/seed-permissions', [RoleController::class, 'seedPermissions'])
        ->name('admin.roles.seed')->middleware('permission:roles.create');

    // Sub-admin (role user) management
    Route::get('/role-users', [RoleUserController::class, 'index'])
        ->name('admin.role-users.index')->middleware('permission:roles.users');
    Route::get('/role-users/create', [RoleUserController::class, 'create'])
        ->name('admin.role-users.create')->middleware('permission:roles.users');
    Route::post('/role-users', [RoleUserController::class, 'store'])
        ->name('admin.role-users.store')->middleware('permission:roles.users');
    Route::get('/role-users/{roleUser}/edit', [RoleUserController::class, 'edit'])
        ->name('admin.role-users.edit')->middleware('permission:roles.users');
    Route::put('/role-users/{roleUser}', [RoleUserController::class, 'update'])
        ->name('admin.role-users.update')->middleware('permission:roles.users');
    Route::patch('/role-users/{roleUser}', [RoleUserController::class, 'update'])
        ->name('admin.role-users.update.patch')->middleware('permission:roles.users');
    Route::delete('/role-users/{roleUser}', [RoleUserController::class, 'destroy'])
        ->name('admin.role-users.destroy')->middleware('permission:roles.users');

    Route::post('/role-users/{roleUser}/toggle-status', [RoleUserController::class, 'toggleStatus'])
        ->name('admin.role-users.toggle')->middleware('permission:roles.users');
});
