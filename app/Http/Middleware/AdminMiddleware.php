<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!in_array(Auth::user()->role, ['admin', 'operator', 'pimpinan'])) {
            abort(403, 'Anda tidak memiliki hak akses ke dasbor ini.');
        }

        return $next($request);
    }
}