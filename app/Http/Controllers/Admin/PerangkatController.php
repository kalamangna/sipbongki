<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerangkatRequest;
use App\Http\Requests\UpdatePerangkatRequest;
use App\Models\Jabatan;
use App\Models\Perangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerangkatController extends Controller
{
    /**
     * Menampilkan daftar perangkat
     */
    public function index()
    {
        $perangkats = Perangkat::with('jabatan')
            ->latest()
            ->paginate(10);

        return view(
            'admin.kependudukan.perangkat.index',
            compact('perangkats')
        );
    }


    /**
     * Form tambah perangkat
     */
    public function create()
{
    $jabatans = Jabatan::orderBy('nama')->get();

    $jabatansStruktur = Jabatan::where('is_struktur',1)
        ->orderBy('nama')
        ->get();

    return view(
        'admin.kependudukan.perangkat.create',
        compact(
            'jabatans',
            'jabatansStruktur'
        )
    );
}


    /**
     * Simpan perangkat baru
     */
    public function store(StorePerangkatRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('perangkat', 'public');
        }

        $data['aktif'] = $request->has('aktif');

        Perangkat::create($data);

        return redirect()
            ->route('admin.perangkat.index')
            ->with('success', 'Data perangkat berhasil ditambahkan.');
    }


    /**
     * Detail perangkat
     */
    public function show(Perangkat $perangkat)
    {
        $perangkat->load('jabatan');

        return view(
            'admin.kependudukan.perangkat.show',
            compact('perangkat')
        );
    }


    /**
     * Form edit perangkat
     */
    public function edit(Perangkat $perangkat)
{
    $jabatans = Jabatan::orderBy('nama')->get();

    $jabatansStruktur = Jabatan::where('is_struktur',1)
        ->orderBy('nama')
        ->get();

    return view(
        'admin.kependudukan.perangkat.edit',
        compact(
            'perangkat',
            'jabatans',
            'jabatansStruktur'
        )
    );
}


    /**
     * Update perangkat
     */
    public function update(UpdatePerangkatRequest $request, Perangkat $perangkat)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
                Storage::disk('public')->delete($perangkat->foto);
            }
            $data['foto'] = $request->file('foto')->store('perangkat', 'public');
        }

        $data['aktif'] = $request->has('aktif');

        $perangkat->update($data);

        return redirect()
            ->route('admin.perangkat.index')
            ->with('success', 'Data perangkat berhasil diperbarui.');
    }


    /**
     * Hapus perangkat
     */
    public function destroy(Perangkat $perangkat)
    {
        if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
            Storage::disk('public')->delete($perangkat->foto);
        }

        $perangkat->delete();

        return redirect()
            ->route('admin.perangkat.index')
            ->with('success', 'Data perangkat berhasil dihapus.');
    }
}