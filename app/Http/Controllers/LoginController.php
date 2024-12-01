<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }

    // Proses login
    public function login_proses(Request $request)
    {
        // Validasi login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Ambil kredensial
        $credentials = $request->only('email', 'password');

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['login' => 'Akun tidak terdaftar.']);
        }

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            // Jika login berhasil, redirect ke halaman utama
            return redirect()->route('dashboard'); // Redirect to main layout
        }

        return redirect()->back()->withErrors(['login' => 'Email atau password salah.']);
    }

    // Menampilkan halaman register
    public function register()
    {
        return view('auth.register');
    }

    // Proses register
    public function register_proses(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Buat user baru tanpa role
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' => 'admin', // Removed role assignment
        ]);

        // Automatically log in the user after registration
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        // Redirect to layouts.main after successful registration
        return redirect()->route('dashboard')->with('success', 'Registration successful.');
    }

    // Proses logout
    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}