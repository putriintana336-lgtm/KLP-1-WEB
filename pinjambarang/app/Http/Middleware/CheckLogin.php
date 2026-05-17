<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        // JIKA TIDAK ADA session 'user_id' (artinya belum login), TENDANG!
        if (!session()->has('user_id')) {
            return redirect('/login'); 
        }

        return $next($request);
    }
}