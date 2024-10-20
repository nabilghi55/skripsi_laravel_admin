<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Cek jika pengguna adalah mentor
        if ($user && $user->role === 'mentor') {
            return $next($request);
        }

        return response()->json(['message' => 'You do not have permission to access this page'], 403);
    }
}
