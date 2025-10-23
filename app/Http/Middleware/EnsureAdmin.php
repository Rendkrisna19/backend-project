<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // pastikan user sudah terautentikasi (auth:sanctum lebih dulu di route)
        if ($request->user()?->role !== 'admin') {
            return response()->json(['message' => 'Admin only'], 403);
        }
        return $next($request);
    }
}
