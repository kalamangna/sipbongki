<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KartuKeluarga;
use App\Models\Lingkungan;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class KartuKeluargaController extends Controller
{
    public function index()
{
    $kartuKeluargas = KartuKeluarga::with([
        'kepalaKeluarga',
        'lingkungan',
        'anggota',
    ])
    ->latest()
    ->paginate(10);

    return view(
        'admin.kependudukan.kartu-keluarga.index',
        compact('kartuKeluargas')
    );
}

    public function create()
    {
        $lingkungans = Lingkungan::orderBy('nama')->get();

        $penduduks = Penduduk::orderBy('nama_lengkap')->get();

        return view(
            'admin.kependudukan.kartu-keluarga.create',
            compact(
                'lingkungans',
                'penduduks'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|size:16|unique:kartu_keluargas',
            'kepala_keluarga_id' => 'nullable|exists:penduduks,id',
            'alamat' => 'nullable',
            'rt' => 'nullable|max:3',
            'rw' => 'nullable|max:3',
            'lingkungan_id' => 'nullable|exists:lingkungans,id',
        ]);

        KartuKeluarga::create($request->all());

        return redirect()
            ->route('admin.kartu-keluarga.index')
            ->with('success', 'Data KK berhasil ditambahkan.');
    }

   public function show(KartuKeluarga $kartuKeluarga)
{
    $kartuKeluarga->load([
        'kepalaKeluarga',
        'lingkungan',
        'anggota'
    ]);

    return view(
        'admin.kependudukan.kartu-keluarga.show',
        compact('kartuKeluarga')
    );
}

    public function edit(KartuKeluarga $kartuKeluarga)
    {
        $lingkungans = Lingkungan::orderBy('nama')->get();

        $penduduks = Penduduk::orderBy('nama_lengkap')->get();

        return view(
            'admin.kependudukan.kartu-keluarga.edit',
            compact(
                'kartuKeluarga',
                'lingkungans',
                'penduduks'
            )
        );
    }

    public function update(
        Request $request,
        KartuKeluarga $kartuKeluarga
    ) {
        $request->validate([
            'no_kk' => 'required|size:16|unique:kartu_keluargas,no_kk,' . $kartuKeluarga->id,
            'kepala_keluarga_id' => 'nullable|exists:penduduks,id',
            'alamat' => 'nullable',
            'rt' => 'nullable|max:3',
            'rw' => 'nullable|max:3',
            'lingkungan_id' => 'nullable|exists:lingkungans,id',
        ]);

        $kartuKeluarga->update($request->all());

        return redirect()
            ->route('admin.kartu-keluarga.index')
            ->with('success', 'Data KK berhasil diperbarui.');
    }

    public function destroy(KartuKeluarga $kartuKeluarga)
    {
        $kartuKeluarga->delete();

        return redirect()
            ->route('admin.kartu-keluarga.index')
            ->with('success', 'Data KK berhasil dihapus.');
    }
}