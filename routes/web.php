<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;

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
| ABOUT
|--------------------------------------------------------------------------
*/
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

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

    // DASHBOARD
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROJECTS (ADMIN FULL CRUD ✅)
    |--------------------------------------------------------------------------
    */
    Route::resource('projects', AdminProjectController::class)
        ->names('admin.projects');

    /*
    |--------------------------------------------------------------------------
    | BLOG ADMIN
    |--------------------------------------------------------------------------
    */
    Route::get('/blogs', [BlogController::class, 'adminIndex'])->name('admin.blogs');

    Route::get('/blog', function () {
        return view('admin.add-blog');
    })->name('admin.blog');

    Route::post('/blog/store', [BlogController::class, 'store'])->name('admin.blog.store');

    Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->name('admin.blog.delete');

    Route::get('/uploads', [BlogController::class, 'uploads'])->name('admin.uploads');

    /*
    |--------------------------------------------------------------------------
    | CONTACTS
    |--------------------------------------------------------------------------
    */
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/trash', [AdminContactController::class, 'trash'])->name('admin.contacts.trash');

    Route::get('/contacts/{id}', [AdminContactController::class, 'show'])->name('admin.contacts.show');

    Route::post('/contacts/{id}/reply', [AdminContactController::class, 'reply'])->name('admin.contacts.reply');

    // Delete (soft)
    Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');
    Route::delete('/contacts-delete-all', [AdminContactController::class, 'deleteAll'])->name('admin.contacts.deleteAll');

    // Trash actions
    Route::post('/contacts/{id}/restore', [AdminContactController::class, 'restore'])->name('admin.contacts.restore');
    Route::post('/contacts-restore-all', [AdminContactController::class, 'restoreAll'])->name('admin.contacts.restoreAll');
    Route::delete('/contacts/{id}/force-delete', [AdminContactController::class, 'forceDelete'])->name('admin.contacts.forceDelete');

    Route::get('/messages', [AdminContactController::class, 'index'])->name('admin.messages');

    // System Utilities
    Route::get('/system', [AdminController::class, 'system'])->name('admin.system');
    Route::post('/system/run-command', [AdminController::class, 'runCommand'])->name('admin.system.run_command');
});