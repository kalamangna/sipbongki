<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request and attach HTTP security headers.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // Content Security Policy hanya aktif di production.
        // Di development, Vite dev server berjalan di origin berbeda (localhost:5173)
        // sehingga CSP akan memblokir hot-reload dan asset styling.
        if (! app()->isLocal()) {
            $response->headers->set('Content-Security-Policy', implode('; ', [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tiny.cloud https://cdnjs.cloudflare.com https://cdn.jsdelivr.net",
                "style-src 'self' 'unsafe-inline' https://cdn.tiny.cloud https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net",
                "img-src 'self' data: blob: https://cdn.tiny.cloud https://sp.tinymce.com",
                "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com",
                "connect-src 'self' https://cdn.tiny.cloud",
                "frame-src 'self' https://www.google.com https://maps.google.com",
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'",
            ]));
        }

        // HTTP Strict Transport Security (HSTS) — hanya aktif jika HTTPS
        if ($request->isSecure()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains'
            );
        }

        return $response;
    }
}
