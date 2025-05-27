<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdminAccess;

Route::get('/', function () {
    return redirect('/login');
});



// Public Routing
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/home', [AuthController::class, 'home'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/topup', [AuthController::class, 'topup'])->middleware('auth');
Route::get('/home', [AuthController::class, 'home'])->middleware('auth');

Route::delete('/admin/user/delete/{id}', [AdminController::class, 'PDeleteUser'])->name('admin.deleteUser');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::post('/buy', [HomeController::class, 'buy']);

    // Route::resource('admin', AdminController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
    
    // Halaman Admin
    Route::get('/admin', [AdminController::class, 'index'])->middleware(IsAdminAccess::class);
    
    // Halaman Admin User
    Route::get('/admin/user', [AdminController::class, 'GShowUser'])->middleware(IsAdminAccess::class);
    Route::post('/admin/user', [AdminController::class, 'PCreateUser'])->middleware(IsAdminAccess::class);
    Route::get('/admin/user/create', [AdminController::class, 'GCreateUser'])->middleware(IsAdminAccess::class);
    Route::post('/admin/user/create', [AdminController::class, 'PCreateUser'])->middleware(IsAdminAccess::class);
    Route::get('/admin/user/edit/{id}', [AdminController::class, 'GUpdateUser'])->middleware(IsAdminAccess::class);
    Route::put('/admin/user/edit/{id}', [AdminController::class, 'PUpdateUser'])->middleware(IsAdminAccess::class);

    // Halaman Topup User Khusus Admin
    Route::get('/admin/topup', [AdminController::class, 'GShowTopup'])->middleware(IsAdminAccess::class);
    Route::put('/admin/topup/add', [AdminController::class, 'PAddTopup'])->middleware(IsAdminAccess::class);
});

