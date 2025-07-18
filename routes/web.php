<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\RedirectIfAuthenticatedByRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('auth.login');
})->middleware(RedirectIfAuthenticatedByRole::class)->name('login');


Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/dashboard', function () {
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'member' => redirect()->route('member.dashboard'),
            'guest' => redirect()->route('guest.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
        ->name('tasks.updateStatus');
});


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


require __DIR__.'/auth.php';
