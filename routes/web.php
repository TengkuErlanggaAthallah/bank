<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\RiwayatController;

// Route for the login page
Route::get('/', [LoginController::class, 'index'])->name('login');

// Route for processing login
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');

// Route for logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Route for registration
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

// Rute untuk menampilkan form transfer
Route::get('/transfer/create', [TransferController::class, 'create'])->middleware('auth')->name('transfer.create');

// Rute untuk menyimpan transfer
Route::post('/transfer', [TransferController::class, 'store'])->middleware('auth')->name('transfer.store');

// Route for the dashboard, requires authentication
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Rute untuk akun
Route::get('/akun/create', [AkunController::class, 'create'])->middleware('auth')->name('akun.create');
Route::post('/akun', [AkunController::class, 'store'])->middleware('auth')->name('akun.store');
Route::get('/akun/{id}', [AkunController::class, 'show'])->middleware('auth')->name('akun.show');

// Profile routes
Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

// Resource routes for Nasabah, Transaksi, and Akun
Route::resource('nasabah', NasabahController::class)->middleware('auth');
Route::resource('akun', AkunController::class)->middleware('auth');
Route::resource('transfer', TransferController::class)->middleware('auth');

// Rute untuk top-up
Route::get('/topup', [TopUpController::class, 'create'])->middleware('auth')->name('topup.create');
Route::post('/topup', [TopUpController::class, 'store'])->middleware('auth')->name('topup.store');

Route::delete('/transfers/{id}', [RiwayatController::class, 'transferdestroy'])->middleware('auth')->name('transfers.destroy');
Route::delete('/topups/{id}', [RiwayatController::class, 'topupdestroy'])->middleware('auth')->name('topups.destroy');