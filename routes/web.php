<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransferController;

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
Route::get('/transfer/create', [TransferController::class, 'create'])->name('transfer.create');

// Rute untuk menyimpan transfer
Route::post('/transfer', [TransferController::class, 'store'])->name('transfer.store');

// Route for the dashboard, requires authentication
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/akun/create', [AkunController::class, 'create'])->name('akun.create');
Route::post('/akun', [AkunController::class, 'store'])->name('akun.store');

// Profile routes
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Resource routes for Nasabah, Transaksi, and Akun
Route::resource('nasabah', NasabahController::class)->middleware('auth');
Route::resource('akun', AkunController::class)->middleware('auth');
Route::resource('transfer', TransferController::class)->middleware('auth');
