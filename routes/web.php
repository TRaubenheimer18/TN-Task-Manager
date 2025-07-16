<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\RedirectIfAuthenticatedByRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Login route: Redirect authenticated users to role-based dashboard
Route::get('/login', function () {
    return view('auth.login');
})->middleware(RedirectIfAuthenticatedByRole::class)->name('login');

// Group routes that require auth and email verification
Route::middleware(['auth', 'verified'])->group(function () {

    // ✅ Dynamic role-based dashboard route
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'member' => redirect()->route('member.dashboard'),
            'guest' => redirect()->route('guest.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Task routes
    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
        ->name('tasks.updateStatus');
});

// ✅ Role-specific dashboard views (only needs 'auth', not 'verified')
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboards.admin');
    })->name('admin.dashboard');

    Route::get('/member/dashboard', function () {
        return view('dashboards.member');
    })->name('member.dashboard');

    Route::get('/guest/dashboard', function () {
        return view('dashboards.guest');
    })->name('guest.dashboard');
});

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

Route::get('/send-test-email', function () {
    Mail::to('test@example.com')->send(new TestMail());
    return 'Test email sent!';
});

// ✅ Auth routes like login, register, etc.
require __DIR__.'/auth.php';
