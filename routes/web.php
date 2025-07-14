<?php


use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

// Show login form
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm']);

// Registration
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Test routes (optional, for debugging)
Route::get('/test-db', function() {
    try {
        DB::connection()->getPdo();
        return "Connected successfully to database: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "Error connecting to database: " . $e->getMessage();
    }
});

Route::get('/check-tasks', function() {
    dd(\App\Models\Task::all());
});

Route::get('/admin/dashboard', fn () => view('dashboard.admin'))->name('admin.dashboard');
Route::get('/team/dashboard', fn () => view('dashboard.team'))->name('team.dashboard');
Route::get('/guest/dashboard', fn () => view('dashboard.guest'))->name('guest.dashboard');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);


require __DIR__.'/auth.php';