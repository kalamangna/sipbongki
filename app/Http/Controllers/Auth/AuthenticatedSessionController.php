<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.admin.login');
    }


    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();


        $request->session()->regenerate();


        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Redirect Berdasarkan Role
        |--------------------------------------------------------------------------
        */


        if (in_array($user->role, ['admin', 'operator', 'pimpinan'])) {
            return redirect()->route('admin.dashboard');
        }

        Auth::logout();

        return redirect()
            ->route('login')
            ->withErrors(['username' => 'Akun ini tidak memiliki akses ke panel administrator. Gunakan akun admin atau operator.']);

    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        Auth::guard('web')->logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();


        return redirect('/');

    }
}