<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna terautentikasi
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Cek apakah pengguna memiliki role alumni
        if (Auth::user()->role !== 'alumni' && Auth::user()->role !== 'mentor') {
            return response()->json(['message' => 'You do not have permission to access this page'], 403);
        }

        return $next($request);
    }
}
