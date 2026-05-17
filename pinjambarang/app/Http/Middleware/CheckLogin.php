<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // PERBAIKAN: Jika session 'user_id' tidak ada, tendang kembali ke halaman login utama
        if (!session()->has('user_id')) {
            // Kita arahkan ke URL '/' karena form login kamu ada di halaman utama
            return redirect('/'); 
        }

        return $next($request);
    }
}