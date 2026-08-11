<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function create()
    {
        return view('auth.login', [
            'loginRoute' => route('login'),
        ]);
    }


    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.'
                ])
                ->onlyInput('username');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if (in_array($user->role, ['admin', 'operator', 'pimpinan'])) {
            return redirect()->route('admin.dashboard');
        }

        Auth::logout();

        return redirect()
            ->route('login')
            ->withErrors([
                'username' => 'Akun ini tidak memiliki akses ke dasbor.'
            ]);
    }



    public function destroy(Request $request)
    {

        Auth::logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();


        return redirect()
            ->route('home');

    }

}