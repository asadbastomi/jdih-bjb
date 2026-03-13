<?php
namespace App\Http\Middleware;

use Closure;

class SecurityHeaders
{
    public function handle($request, Closure $next)
    {
       $response = $next($request);

        // Header Keamanan Standar
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // CSP yang sudah disesuaikan agar Leaflet, Google Fonts, dan CDN pihak ketiga bisa berjalan
         $csp = "default-src 'self'; " .
             "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://unpkg.com https://cdn.jsdelivr.net https://translate.google.com https://translate.googleapis.com https://cdn.userway.org https://static.elfsight.com https://static.cloudflareinsights.com; " .
             "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net https://unpkg.com https://www.gstatic.com; " .
             "font-src 'self' https://fonts.gstatic.com data:; " .
             "img-src 'self' data: https://upload.wikimedia.org https://play-lh.googleusercontent.com https://unpkg.com https://*.tile.openstreetmap.org; " .
             "connect-src 'self' https://translate.googleapis.com https://unpkg.com https://cdn.jsdelivr.net https://core.service.elfsight.com;";
               
        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}