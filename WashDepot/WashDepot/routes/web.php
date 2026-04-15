<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\NewLaundryController;

// Route::get('/', function () {
//     return view('login');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('/staff/shop', function() {
//     return view('staff.new-customer');
// });

// require __DIR__.'/auth.php';
// Route::get('/login', function() {
//     return view('login');
// });
// Route::get('/admin/shop', function() {
//     return view('admin.shop');
// });


// // Public
// Route::get('/', function() { return view('login'); });

// // Staff Routes
// Route::middleware(['auth'])->prefix('staff')->group(function() {
//     Route::get('/new-laundry', [QueueController::class, 'create']);
//     Route::post('/new-laundry', [QueueController::class, 'store']);
//     Route::get('/queue', [QueueController::class, 'index']);
//     Route::post('/queue/{id}/status', [QueueController::class, 'updateStatus']);
// });
// Public routes
Route::get('/', function() { return redirect('/login'); });
Route::get('/queue-status', function() { return view('public.queue'); });

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Staff routes
Route::middleware(['auth'])->prefix('staff')->group(function() {
    Route::get('/new-laundry', [NewLaundryController::class, 'create']);
    Route::post('/new-laundry', [NewLaundryController::class, 'store']);
    Route::get('/queue', [QueueController::class, 'index']);
    Route::post('/queue/{id}/status', [QueueController::class, 'updateStatus']);
    Route::get('/inventory', function() { return view('staff.inventory'); });
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::get('/shop', function() { return view('admin.shop'); });
});