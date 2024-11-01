<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {

        $user = Auth::user();

        // Log pengguna untuk debugging
        Log::info('Checking user role:', ['user' => $user]);

        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            return response()->json(['message' => 'Unauthorized
      access'], 403);
        }
        return $next($request);
    }
}
