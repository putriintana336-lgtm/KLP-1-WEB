<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $user = User::where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if ($user) {
            session(['user_id' => $user->id]);

            return redirect('/peminjaman');
        }

        return back();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => $request->password,
            'role'     => 'user',
        ]);

        return redirect('/');
    }

    public function logout()
    {
        session()->forget('user_id');

        return redirect('/');
    }
}
