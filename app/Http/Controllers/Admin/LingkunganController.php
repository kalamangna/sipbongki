<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLingkunganRequest;
use App\Http\Requests\UpdateLingkunganRequest;
use App\Models\Lingkungan;
use App\Models\Perangkat;
use Illuminate\Http\Request;

class LingkunganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $lingkungans = Lingkungan::when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.referensi.lingkungan.index',
            compact('lingkungans', 'search')
        );
    }

    public function create()
    {
        $kepalaLingkungans = \App\Models\Perangkat::with('jabatanStruktur')
            ->where('aktif', true)
            ->whereHas('jabatanStruktur', function ($query) {
                $query->where('is_struktur', true)
                    ->where('nama', 'like', 'Kepala Lingkungan%');
            })
            ->orderBy('nama_lengkap')
            ->get();

        return view('admin.referensi.lingkungan.create', compact('kepalaLingkungans'));
    }

    public function store(StoreLingkunganRequest $request)
    {
        Lingkungan::create($request->validated());

        return redirect()
            ->route('admin.lingkungan.index')
            ->with('success', 'Data lingkungan berhasil ditambahkan.');
    }

    public function show(Lingkungan $lingkungan)
    {
        $kepalaLingkungan = Perangkat::with('jabatanStruktur')
            ->where('aktif', true)
            ->where('nama_lengkap', $lingkungan->ketua_lingkungan)
            ->first();

        return view(
            'admin.referensi.lingkungan.show',
            compact('lingkungan', 'kepalaLingkungan')
        );
    }

    public function edit(Lingkungan $lingkungan)
    {
        $kepalaLingkungans = \App\Models\Perangkat::with('jabatanStruktur')
            ->where('aktif', true)
            ->whereHas('jabatanStruktur', function ($query) {
                $query->where('is_struktur', true)
                    ->where('nama', 'like', 'Kepala Lingkungan%');
            })
            ->orderBy('nama_lengkap')
            ->get();

        return view(
            'admin.referensi.lingkungan.edit',
            compact('lingkungan', 'kepalaLingkungans')
        );
    }

    public function update(UpdateLingkunganRequest $request, Lingkungan $lingkungan)
    {
        $lingkungan->update($request->validated());

        return redirect()
            ->route('admin.lingkungan.show', $lingkungan)
            ->with('success', 'Data lingkungan berhasil diperbarui.');
    }

    public function destroy(Lingkungan $lingkungan)
    {
        $lingkungan->delete();

        return redirect()
            ->route('admin.lingkungan.index')
            ->with('success', 'Data lingkungan berhasil dihapus.');
    }
}