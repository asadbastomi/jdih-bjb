<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApiOrWebAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if user is authenticated via API token
        if (Auth::guard('api')->check()) {
            return $next($request);
        }

        // Check if user is authenticated via web session
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        // If neither authentication method works, return unauthorized
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        return redirect()->route('login');
    }
}