<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController; // Controller admin umum Anda
use App\Http\Controllers\Admin\DiamondController; // Pastikan namespace ini benar
use App\Http\Middleware\IsAdminAccess;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

// Public Routing (Authentication)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']); // login action

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']); // register action

// Routes for Authenticated Users (Non-Admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home'); // Halaman home user
    Route::post('/buy', [HomeController::class, 'buy'])->name('buy'); // Proses beli
    Route::put('/profile/update', [HomeController::class, 'updateProfile'])->name('profile.update'); // Update profil user
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Logout (sebaiknya POST)

    // Route::post('/topup', [AuthController::class, 'topup']); // Jika ini topup oleh user, letakkan di sini. Namanya bentrok dgn AdminController
                                                              // Mungkin ini [HomeController::class, 'requestTopup']?
});


// Admin Routes
Route::middleware(['auth', IsAdminAccess::class]) // Semua route di grup ini butuh login DAN IsAdminAccess
    ->prefix('admin')                         // URL akan diawali dengan /admin
    ->name('admin.')                          // Nama route akan diawali dengan admin. (cth: admin.dashboard)
    ->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('dashboard'); // Ganti 'index' dengan 'dashboard' agar lebih jelas: admin.dashboard

    // User Management (Admin)
    Route::prefix('user')->name('user.')->group(function() {
        Route::get('/', [AdminController::class, 'GShowUser'])->name('index'); // admin.user.index
        Route::get('/create', [AdminController::class, 'GCreateUser'])->name('create'); // admin.user.create
        Route::post('/create', [AdminController::class, 'PCreateUser'])->name('store'); // admin.user.store (menggunakan POST untuk create)
        Route::get('/edit/{id}', [AdminController::class, 'GUpdateUser'])->name('edit'); // admin.user.edit
        Route::put('/edit/{id}', [AdminController::class, 'PUpdateUser'])->name('update'); // admin.user.update
        Route::delete('/delete/{id}', [AdminController::class, 'PDeleteUser'])->name('delete'); // admin.user.delete
    });
    // Catatan: Untuk User Management, Anda juga bisa menggunakan Route::resource jika controllernya mengikuti konvensi resource.

    // Topup Management (Admin)
    Route::prefix('topup')->name('topup.')->group(function() {
        Route::get('/', [AdminController::class, 'GShowTopup'])->name('index'); // admin.topup.index
        Route::put('/add', [AdminController::class, 'PAddTopup'])->name('store'); // admin.topup.store (atau 'update' jika ini mengupdate saldo user)
    });

    // Diamond CRUD (Admin)
    // Pastikan DiamondController ada di App\Http\Controllers\Admin\DiamondController
    // atau sesuaikan namespace di 'use' statement di atas.
    Route::resource('diamonds', DiamondController::class);
    // Ini akan membuat route seperti:
    // admin.diamonds.index   (GET /admin/diamonds)
    // admin.diamonds.create  (GET /admin/diamonds/create)
    // admin.diamonds.store   (POST /admin/diamonds)
    // admin.diamonds.show    (GET /admin/diamonds/{diamond}) - Anda mungkin tidak pakai ini
    // admin.diamonds.edit    (GET /admin/diamonds/{diamond}/edit)
    // admin.diamonds.update  (PUT/PATCH /admin/diamonds/{diamond})
    // admin.diamonds.destroy (DELETE /admin/diamonds/{diamond})
});

// Catatan:
// Route::get('/home', [AuthController::class, 'home'])->middleware('auth');
// Anda memiliki ini dua kali. Sebaiknya salah satu dihapus dan gunakan HomeController untuk /home setelah login.
// Saya sudah memindahkannya ke grup auth utama dan menggunakan HomeController.

// Route::delete('/admin/user/delete/{id}', [AdminController::class, 'PDeleteUser'])->name('admin.deleteUser');
// Ini sudah saya pindahkan ke dalam grup admin agar terlindungi.