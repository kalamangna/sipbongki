<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKartuKeluargaRequest;
use App\Http\Requests\UpdateKartuKeluargaRequest;
use App\Models\KartuKeluarga;
use App\Models\Lingkungan;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KartuKeluargaController extends Controller
{
public function index(Request $request)
{
    $keyword = trim($request->keyword ?? '');
    $lingkungan = $request->lingkungan;
    $aktif = $request->aktif;

    $kartuKeluargas = KartuKeluarga::with([
        'kepalaKeluarga',
        'lingkungan',
        'anggota',
    ])
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('no_kk', 'like', "%{$keyword}%")
                ->orWhereHas('kepalaKeluarga', function ($q) use ($keyword) {
                    $q->where('nama_lengkap', 'like', "%{$keyword}%");
                });
        })
    ->when($lingkungan, function ($query) use ($lingkungan) {
        $query->where('lingkungan_id', $lingkungan);
    })
    ->when($request->has('aktif') && $aktif !== '' && $aktif !== null, function ($query) use ($aktif) {
        $query->where('aktif', $aktif);
    })
    ->latest()
    ->paginate(10)
    ->withQueryString();

    $lingkungans = Lingkungan::orderBy('nama')->get();

    // Statistik Kartu Keluarga
    $totalSemua = KartuKeluarga::count();
    $totalAktif = KartuKeluarga::where('aktif', 1)->count();
    $totalTidakAktif = KartuKeluarga::where('aktif', 0)->count();

    return view(
        'admin.kependudukan.kartu-keluarga.index',
        compact(
            'kartuKeluargas',
            'keyword',
            'lingkungan',
            'lingkungans',
            'aktif',
            'totalSemua',
            'totalAktif',
            'totalTidakAktif'
        )
    );
}
    public function create()
    {
        $lingkungans = Lingkungan::orderBy('nama')->get();

                $penduduks = Penduduk::with('kartuKeluarga')
                ->where(function($q){
                        $q->whereNull('kartu_keluarga_id')
                            ->orWhereNull('hubungan_keluarga');
                })
                ->orderBy('nama_lengkap')
                ->get();

        return view(
            'admin.kependudukan.kartu-keluarga.create',
            compact(
                'lingkungans',
                'penduduks'
            )
        );
    }

    public function getPenduduk(Penduduk $penduduk)
{
    return response()->json([
        'alamat'        => $penduduk->alamat,
        'rt'            => $penduduk->rt,
        'rw'            => $penduduk->rw,
        'lingkungan_id' => $penduduk->lingkungan_id,
    ]);
}

    public function store(StoreKartuKeluargaRequest $request)
    {
        $validated = $request->validated();
        $selected = collect($request->input('anggota', []))
            ->pluck('penduduk_id')
            ->toArray();

        $kepala = $request->kepala_keluarga_id;

$idsToCheck = $selected;

if ($kepala && !in_array($kepala, $idsToCheck)) {
    $idsToCheck[] = $kepala;
}


        if (!empty($idsToCheck)) {
            $already = Penduduk::whereIn('id', $idsToCheck)
                ->whereNotNull('kartu_keluarga_id')
                ->get();

            if ($already->count() && !$request->has('force_reassign')) {
                $names = $already->pluck('nama_lengkap')->join(', ');

                return back()
                    ->withInput()
                    ->withErrors([
                        'anggota' => "Beberapa penduduk sudah terdaftar di KK lain: {$names}. Centang opsi konfirmasi untuk memaksa pemindahan.",
                    ]);
            }
        }

        $data = $request->only([
            'no_kk',
            'kepala_keluarga_id',
            'alamat',
            'rt',
            'rw',
            'lingkungan_id',
        ]);

        $kk = KartuKeluarga::create($data);

       foreach ($request->anggota ?? [] as $anggota) {

    Penduduk::where('id', $anggota['penduduk_id'])
        ->update([

            'kartu_keluarga_id' => $kk->id,

            'hubungan_keluarga' => $anggota['hubungan'],

        ]);

}

        // Jadikan kepala keluarga
        if ($request->kepala_keluarga_id) {
            Penduduk::where('id', $request->kepala_keluarga_id)
                ->update([
                    'kartu_keluarga_id' => $kk->id,
                    'hubungan_keluarga' => 'Kepala Keluarga',
                ]);
        }
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

     $anggotaKeluarga = Penduduk::where(
        'kartu_keluarga_id',
        $kartuKeluarga->id
    )
    ->where('id', '!=', $kartuKeluarga->kepala_keluarga_id)
    ->orderBy('hubungan_keluarga')
    ->orderBy('nama_lengkap')
    ->get();

    return view(
        'admin.kependudukan.kartu-keluarga.edit',
        compact(
            'kartuKeluarga',
            'lingkungans',
            'penduduks',
            'anggotaKeluarga'
        )
    );
}


    public function update(
        UpdateKartuKeluargaRequest $request,
        KartuKeluarga $kartuKeluarga
    ) {
        $validated = $request->validated();

        DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | Update data KK
        |--------------------------------------------------------------------------
        */

        $kartuKeluarga->update([
            'no_kk' => $request->no_kk,
            'kepala_keluarga_id' => $request->kepala_keluarga_id,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'lingkungan_id' => $request->lingkungan_id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Lepaskan semua anggota lama
        |--------------------------------------------------------------------------
        */

        Penduduk::where('kartu_keluarga_id', $kartuKeluarga->id)
            ->update([
                'kartu_keluarga_id' => null,
                'hubungan_keluarga' => null,
            ]);

        /*
        |--------------------------------------------------------------------------
        | Simpan anggota baru
        |--------------------------------------------------------------------------
        */

        foreach ($request->anggota ?? [] as $anggota) {

            Penduduk::where('id', $anggota['penduduk_id'])
                ->update([
                    'kartu_keluarga_id' => $kartuKeluarga->id,
                    'hubungan_keluarga' => $anggota['hubungan'],
                ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Pastikan kepala keluarga benar
        |--------------------------------------------------------------------------
        */

        if ($request->kepala_keluarga_id) {

            Penduduk::where('id', $request->kepala_keluarga_id)
                ->update([
                    'kartu_keluarga_id' => $kartuKeluarga->id,
                    'hubungan_keluarga' => 'Kepala Keluarga',
                ]);

        }

        DB::commit();

        return redirect()
            ->route('admin.kartu-keluarga.index')
            ->with('success', 'Data KK berhasil diperbarui.');

    } catch (\Throwable $e) {

        DB::rollBack();

        throw $e;
    }
}

    public function destroy(KartuKeluarga $kartuKeluarga)
{
    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | Lepaskan seluruh anggota KK
        |--------------------------------------------------------------------------
        */

        Penduduk::where('kartu_keluarga_id', $kartuKeluarga->id)
            ->update([
                'kartu_keluarga_id' => null,
                'hubungan_keluarga' => null,
            ]);

        /*
        |--------------------------------------------------------------------------
        | Hapus KK
        |--------------------------------------------------------------------------
        */

        $kartuKeluarga->delete();

        DB::commit();

        return redirect()
            ->route('admin.kartu-keluarga.index')
            ->with('success', 'Data KK berhasil dihapus.');

    } catch (\Throwable $e) {

        DB::rollBack();

        throw $e;
    }
}
}