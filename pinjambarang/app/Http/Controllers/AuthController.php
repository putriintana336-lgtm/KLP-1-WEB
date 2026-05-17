<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Wajib di-import untuk cek password terenkripsi

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('user_id')) {
            return redirect('/peminjaman');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Ambil user berdasarkan email (yang diketik di input 'username')
        $user = User::where('email', $request->username)->first();

        // 2. Cek apakah usernya ada, dan cek apakah passwordnya cocok dengan Hash database
        if ($user && Hash::check($request->password, $user->password)) {
            session(['user_id' => $user->id]);

            return redirect('/peminjaman');
        }

        // Jika salah, kembali dengan pesan error
        return back()->with('error', 'Email atau password salah!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Menyimpan data registrasi baru ke kolom database yang benar
        User::create([
            'name'     => $request->name,
            'email'    => $request->username, // Teks input username disimpan ke kolom email
            'password' => Hash::make($request->password), // Di-hash agar aman dan sesuai standar seeder
            'role'     => 'peminjam', // Default role untuk pendaftar baru sesuai enum migration
            'no_hp'    => $request->no_hp ?? null,
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil, silakan login!');
    }

    public function logout()
    {
        session()->forget('user_id');

        return redirect('/');
    }
}