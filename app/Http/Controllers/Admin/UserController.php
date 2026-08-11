<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::with('penduduk')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengaturan.user.index', compact('users', 'search'));
    }

    public function create()
    {
        return view('admin.pengaturan.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'role' => ['required', 'in:admin,operator,pimpinan'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.pengaturan.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username,' . $user->id],
            'role' => ['required', 'in:admin,operator,pimpinan'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.user.index')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function roles()
    {
        return view('admin.pengaturan.user.roles');
    }
}
