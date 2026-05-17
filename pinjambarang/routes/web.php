<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;

// ==========================================
// RUTE AUTENTIKASI (LOGIN & REGISTER)
// ==========================================
Route::controller(AuthController::class)->group(function () {
    // Jalur utama form login
    Route::get('/', 'showLogin')->name('login');
    
    // Rute cadangan agar GET /login didukung penuh oleh sistem
    Route::get('/login', 'showLogin'); 
    
    // Proses submit data form login & register
    Route::post('/login', 'login');
    Route::get('/register', 'showRegister');
    Route::post('/register', 'register');
    Route::get('/logout', 'logout');
});

// ==========================================
// RUTE YANG WAJIB LOGIN (MIDDLEWARE)
// ==========================================
Route::middleware('check.login')->group(function () {

    // --- MANAJEMEN BARANG ---
    Route::prefix('barang')->controller(BarangController::class)->group(function () {
        Route::get('/', 'index');

        // Khusus Hak Akses Admin
        Route::middleware('check.role:admin')->group(function () {
            Route::get('/create', 'create');
            Route::post('/', 'store');
            Route::get('/{id}/edit', 'edit');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

    // --- MANAJEMEN PEMINJAMAN ---
    Route::prefix('peminjaman')->controller(PeminjamanController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/', 'store');

        // Khusus Hak Akses Admin (Persetujuan Status Pinjam)
        Route::middleware('check.role:admin')->group(function () {
            Route::post('/{id}/status', 'updateStatus');
        });
    });

});