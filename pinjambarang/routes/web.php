<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;

<<<<<<< HEAD
// =========================================================================
// 1. RUTE PUBLIK / TAMU (Bisa diakses tanpa login & AMAN dari eror 401 / 405)
// =========================================================================
Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); // Menangani GET /login (mencegah eror 405)
Route::post('/login', [AuthController::class, 'login']);                  // Menangani POST /login saat klik submit
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

// =========================================================================
// 2. RUTE PROTEKSI (Harus Login terlebih dahulu)
// =========================================================================
Route::middleware(['check.login'])->group(function () {
    Route::get('/barang', [BarangController::class, 'index']);
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);

    // =====================================================================
    // 3. RUTE KHUSUS ADMIN
    // =====================================================================
    Route::middleware(['check.role:admin'])->group(function () {
        Route::get('/barang/create', [BarangController::class, 'create']);
        Route::post('/barang', [BarangController::class, 'store']);
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
        Route::put('/barang/{id}', [BarangController::class, 'update']);
        Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
        Route::post('/peminjaman/{id}/status', [PeminjamanController::class, 'updateStatus']);
=======
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'showLogin');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegister');
    Route::post('/register', 'register');
    Route::get('/logout', 'logout');
});

Route::middleware('check.login')->group(function () {

    Route::prefix('barang')->controller(BarangController::class)->group(function () {
        Route::get('/', 'index');

        Route::middleware('check.role:admin')->group(function () {
            Route::get('/create', 'create');
            Route::post('/', 'store');
            Route::get('/{id}/edit', 'edit');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
>>>>>>> a723ed59228e58348b8c76ff52b6430086bc0d81
    });

    Route::prefix('peminjaman')->controller(PeminjamanController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/', 'store');

        Route::middleware('check.role:admin')->group(function () {
            Route::post('/{id}/status', 'updateStatus');
        });
    });

});
