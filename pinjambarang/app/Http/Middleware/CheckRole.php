<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = User::find(session('user_id'));

        if (!$user || $user->role !== $role) {
            abort(403);
        }

        return $next($request);
    }
}