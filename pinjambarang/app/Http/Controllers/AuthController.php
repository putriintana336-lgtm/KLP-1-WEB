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
        // 1. Validasi input form login
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // 2. Cari user berdasarkan email yang diinput
        $user = User::where('email', $request->email)->first();

        // 3. Cek apakah user ada DAN password-nya cocok (Menggunakan Hash::check)
        if ($user && Hash::check($request->password, $user->password)) {
            
            // 4. SIMPAN SESSION (Sangat Penting! Harus cocok dengan 'user_id')
            session([
                'login'   => true,
                'user_id' => $user->id,
                'role'    => $user->role
            ]);

            // 5. REDIRECT: Lempar ke dashboard utama (ganti /barang sesuai rute kalian)
            return redirect('/barang')->with('success', 'Selamat datang kembali, ' . $user->name);
        }

        // 6. JIKA GAGAL: Kembalikan ke login dengan pesan eror
        return back()->with('error', 'Email atau password salah!')->withInput();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi tanpa no_hp
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Proses insert tanpa no_hp
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'peminjam', // otomatis jadi role peminjam
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil, silakan login!');
    }

    public function logout()
    {
        session()->forget('user_id');

        return redirect('/');
    }
}