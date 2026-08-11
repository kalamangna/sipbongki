<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OperatorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('operator.login');
        }

        if (auth()->user()->role !== 'operator') {
            abort(403, 'Anda tidak memiliki hak akses sebagai Operator.');
        }

        return $next($request);
    }
}