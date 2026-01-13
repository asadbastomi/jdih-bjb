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
        // Try to check if user is authenticated via API token
        try {
            if (Auth::guard('api')->check()) {
                return $next($request);
            }
        } catch (\Exception $e) {
            // If API guard fails (e.g., missing Passport keys), fall through to web guard
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
