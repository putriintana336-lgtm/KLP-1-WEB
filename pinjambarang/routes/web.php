<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;

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