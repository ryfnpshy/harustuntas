<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::post('/buy', [HomeController::class, 'buy']);
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/home', [AuthController::class, 'home'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/topup', [AuthController::class, 'topup'])->middleware('auth');
Route::get('/home', [AuthController::class, 'home'])->middleware('auth');

