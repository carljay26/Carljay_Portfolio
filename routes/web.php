<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

/*
|--------------------------------------------------------------------------
| Public / Viewer Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// TEMP route to create admin in production; remove after first use
Route::get('/create-admin-once', function () {
    if (! app()->environment('production')) {
        abort(404);
    }

    $admin = Admin::updateOrCreate(
        ['email' => 'carljaycocamas26@gmail.com'],
        [
            'name' => 'Carl Jay Cocamas',
            'password' => Hash::make('Admin@1234'),
            'is_super_admin' => 1,
        ]
    );

    return 'Admin created/updated for '.$admin->email;
});

// Alias used by Laravel's auth redirection
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest-only
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // Authenticated admin
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Content
        Route::get('/content', [ContentController::class, 'index'])->name('content');
        Route::post('/content', [ContentController::class, 'update'])->name('content.update');

        // Skills (AJAX sub-actions on content page)
        Route::post('/skills', [ContentController::class, 'addSkill'])->name('skills.store');
        Route::delete('/skills/{skill}', [ContentController::class, 'deleteSkill'])->name('skills.destroy');

        // Education (AJAX sub-actions on content page)
        Route::post('/education', [ContentController::class, 'addEducation'])->name('education.store');
        Route::delete('/education/{education}', [ContentController::class, 'deleteEducation'])->name('education.destroy');

        // Projects
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
        Route::post('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
        Route::delete('/projects/{id}/force', [ProjectController::class, 'forceDelete'])->name('projects.force-delete');
        Route::delete('/projects/archived/clear', [ProjectController::class, 'clearArchive'])->name('projects.clear-archive');

        // Messages
        Route::get('/messages', [MessageController::class, 'index'])->name('messages');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');
        Route::post('/messages/{message}/read', [MessageController::class, 'markRead'])->name('messages.read');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

        // Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    });
});
