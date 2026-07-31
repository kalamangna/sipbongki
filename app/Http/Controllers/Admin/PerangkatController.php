<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        $data = $this->validateData($request);


        /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            $data['foto'] = $request
                ->file('foto')
                ->store('perangkat', 'public');

        }


        /*
        |--------------------------------------------------------------------------
        | Status Aktif
        |--------------------------------------------------------------------------
        */

        $data['aktif'] = $request->has('aktif');


        Perangkat::create($data);


        return redirect()
            ->route('admin.perangkat.index')
            ->with(
                'success',
                'Data perangkat berhasil ditambahkan.'
            );
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
    public function update(Request $request, Perangkat $perangkat)
    {
        $data = $this->validateData($request);


        /*
        |--------------------------------------------------------------------------
        | Update Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {


            if (
                $perangkat->foto &&
                Storage::disk('public')
                    ->exists($perangkat->foto)
            ) {

                Storage::disk('public')
                    ->delete($perangkat->foto);

            }


            $data['foto'] = $request
                ->file('foto')
                ->store('perangkat', 'public');

        }


        /*
        |--------------------------------------------------------------------------
        | Status Aktif
        |--------------------------------------------------------------------------
        */

        $data['aktif'] = $request->has('aktif');


        $perangkat->update($data);


        return redirect()
            ->route('admin.perangkat.index')
            ->with(
                'success',
                'Data perangkat berhasil diperbarui.'
            );
    }


    /**
     * Hapus perangkat
     */
    public function destroy(Perangkat $perangkat)
    {


        if (
            $perangkat->foto &&
            Storage::disk('public')
                ->exists($perangkat->foto)
        ) {

            Storage::disk('public')
                ->delete($perangkat->foto);

        }


        $perangkat->delete();


        return redirect()
            ->route('admin.perangkat.index')
            ->with(
                'success',
                'Data perangkat berhasil dihapus.'
            );
    }


    /**
     * Validasi data perangkat
     */
    private function validateData(Request $request)
    {
        return $request->validate([

            'nama_lengkap'
                => 'required|string|max:255',

            'nip'
                => 'nullable|string|max:30',

            'jabatan_id'
                => 'nullable|exists:jabatans,id',
            
                'jabatan_struktur_id'
            => 'nullable|exists:jabatans,id',

            'level'
                => 'required|integer|min:1|max:5',

            'jenis_kelamin'
                => 'nullable|in:L,P',

            'tempat_lahir'
                => 'nullable|string|max:100',

            'tanggal_lahir'
                => 'nullable|date',

            'pendidikan'
                => 'nullable|string|max:100',

            'telepon'
                => 'nullable|string|max:20',

            'email'
                => 'nullable|email|max:255',

            'alamat'
                => 'nullable|string',

            'tanggal_mulai_jabatan'
                => 'nullable|date',

            'tanggal_selesai_jabatan'
                => 'nullable|date',

            'foto'
                => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'aktif'
                => 'nullable|boolean',

            'keterangan'
                => 'nullable|string',

        ]);
    }
}