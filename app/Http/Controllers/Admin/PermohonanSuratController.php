<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\Penduduk;
use App\Models\PermohonanSurat;
use App\Models\PermohonanSuratHistory;
use App\Models\Perangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Surat\TemplateSuratService;
use App\Services\Surat\NomorSuratService;

class PermohonanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $permohonans = PermohonanSurat::with([
                'penduduk',
                'jenisSurat',
                'penandatangan.jabatan',
            ])
            ->when($search, function ($query) use ($search) {

                $query->where('nomor_permohonan', 'like', "%{$search}%")
                    ->orWhereHas('penduduk', function ($q) use ($search) {

                        $q->where('nama_lengkap', 'like', "%{$search}%")
                          ->orWhere('nik', 'like', "%{$search}%");

                    });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.pelayanan.permohonan-surat.index',
            compact(
                'permohonans',
                'search'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penduduks = Penduduk::orderBy('nama_lengkap')->get();

        $jenisSurats = JenisSurat::orderBy('nama')->get();

      $penandatangans = Perangkat::with('jabatan')
    ->where('aktif', true)
    ->whereHas('jabatan', function ($q) {
        $q->where('aktif', true);
    })
    ->orderBy('jabatan_id')
    ->orderBy('nama_lengkap')
    ->get();

        return view(
            'admin.pelayanan.permohonan-surat.create',
            compact(
                'penduduks',
                'jenisSurats',
                'penandatangans'
            )
        );
    }

  /**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $validated = $request->validate([

    'penduduk_id'      => 'nullable|exists:penduduks,id',

    'jenis_surat_id'   => 'required|exists:jenis_surats,id',

    'penandatangan_id' => 'required|exists:perangkats,id',

    'tanggal_permohonan' => 'required|date',

    'keperluan' => 'required|string|max:1000',

    'catatan' => 'nullable|string',
]);

    /*
    |--------------------------------------------------------------------------
    | Data Surat (Khusus Surat Keterangan Usaha)
    |--------------------------------------------------------------------------
    */

    $jenisSurat = JenisSurat::findOrFail(
        $request->jenis_surat_id
    );
/*
|--------------------------------------------------------------------------
| Validasi Surat Keterangan Usaha
|--------------------------------------------------------------------------
*/

if (

    strtoupper($jenisSurat->kode) === 'USAHA'

    ||

    str_contains(
        strtolower($jenisSurat->nama),
        'usaha'
    )

) {

    $request->validate([

        'nama_usaha' => 'required|string|max:150',

        'jenis_usaha' => 'required|string|max:150',

        'alamat_usaha' => 'nullable|string|max:255',

        'lama_usaha' => 'nullable|string|max:100',

    ]);

}
    $dataSurat = [];

switch (strtoupper($jenisSurat->kode)) {

    case 'USAHA':

        $request->validate([
            'nama_usaha'   => 'required|string|max:150',
            'jenis_usaha'  => 'required|string|max:150',
            'alamat_usaha' => 'nullable|string|max:255',
            'lama_usaha'   => 'nullable|string|max:100',
        ]);

        $dataSurat = [
            'nama_usaha'   => $request->nama_usaha,
            'jenis_usaha'  => $request->jenis_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'lama_usaha'   => $request->lama_usaha,
        ];

        break;

    case 'KEMATIAN':

    $request->validate([
        'almarhum_id'        => 'required|exists:penduduks,id',
        'pelapor_id'         => 'required|exists:penduduks,id',
        'hari_meninggal'     => 'required|string|max:30',
        'tanggal_meninggal'  => 'required|date',
        'jam_meninggal'      => 'nullable',
        'tempat_meninggal'   => 'required|string|max:150',
        'penyebab_kematian'  => 'required|string|max:255',
        'hubungan_pelapor'   => 'required|string|max:100',
    ]);

    // simpan almarhum sebagai penduduk utama permohonan
    $validated['penduduk_id'] = $request->almarhum_id;

    // simpan pelapor
    $validated['pelapor_id'] = $request->pelapor_id;

    $dataSurat = [
        'hari_meninggal'     => $request->hari_meninggal,
        'tanggal_meninggal'  => $request->tanggal_meninggal,
        'jam_meninggal'      => $request->jam_meninggal,
        'tempat_meninggal'   => $request->tempat_meninggal,
        'penyebab_kematian'  => $request->penyebab_kematian,
        'hubungan_pelapor'   => $request->hubungan_pelapor,
    ];

    break;

    case 'ORANG-SAMA':

    $request->validate([

        'nama_lain' => 'required|string|max:150',

        'jenis_dokumen' => 'required|string|max:150',

        'nomor_dokumen' => 'required|string|max:100',

        'keterangan_perbedaan' => 'nullable|string|max:500',

    ]);


    $dataSurat = [

        'nama_lain' => $request->nama_lain,

        'jenis_dokumen' => $request->jenis_dokumen,

        'nomor_dokumen' => $request->nomor_dokumen,

        'keterangan_perbedaan' => $request->keterangan_perbedaan,

    ];

break;
}

    /*
    |--------------------------------------------------------------------------
    | Data Permohonan
    |--------------------------------------------------------------------------
    */

    $validated['nomor_permohonan'] =
        'PMH-' . now()->format('YmdHis');

    $validated['status'] = 'Menunggu';

    $validated['data_surat'] = $dataSurat;
    if (!$validated['penduduk_id']) {
    return back()
        ->withInput()
        ->withErrors([
            'penduduk_id' => 'Penduduk belum dipilih.'
        ]);
}

    $permohonan = PermohonanSurat::create(
        $validated
    );

    /*
    |--------------------------------------------------------------------------
    | Riwayat
    |--------------------------------------------------------------------------
    */

    PermohonanSuratHistory::create([

        'permohonan_surat_id' => $permohonan->id,

        'status_lama' => null,

        'status_baru' => 'Menunggu',

        'catatan' => 'Permohonan dibuat.',

        'user_id' => Auth::id(),

    ]);

    return redirect()

        ->route('admin.permohonan-surat.index')

        ->with(

            'success',

            'Permohonan surat berhasil ditambahkan.'

        );
}


    /**
     * Display the specified resource.
     */
    public function show(PermohonanSurat $permohonanSurat)
    {
        $permohonanSurat->load([

            'penduduk',
            'jenisSurat',
            'penandatangan.jabatan',
            'histories.user',

        ]);

         return view(
        'admin.pelayanan.permohonan-surat.show',
        compact('permohonanSurat')
    );
}

/**
 * Preview Surat
 */
public function preview(PermohonanSurat $permohonanSurat)
{
    $permohonanSurat->load([
        'penduduk',
        'pelapor',
        'jenisSurat',
        'penandatangan.jabatan',
    ]);

    $template = app(TemplateSuratService::class)
        ->getView($permohonanSurat->jenisSurat);

    return view(
        $template,
        [
            'permohonan'    => $permohonanSurat,
            'penduduk'      => $permohonanSurat->penduduk,
            'pelapor'       => $permohonanSurat->pelapor,
            'penandatangan' => $permohonanSurat->penandatangan,
        ]
    );
}


/**
 * Cetak Surat
 */
public function print(PermohonanSurat $permohonanSurat)
{
    $permohonanSurat->load([
        'penduduk',
        'pelapor',
        'jenisSurat',
        'penandatangan.jabatan',
    ]);

    $template = app(TemplateSuratService::class)
        ->getView($permohonanSurat->jenisSurat);

    return view(
        $template,
        [
            'permohonan'    => $permohonanSurat,
            'penduduk'      => $permohonanSurat->penduduk,
            'pelapor'       => $permohonanSurat->pelapor,
            'penandatangan' => $permohonanSurat->penandatangan,
            'print'         => true,
        ]
    );
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PermohonanSurat $permohonanSurat)
    {
        $penduduks = Penduduk::orderBy('nama_lengkap')->get();

        $jenisSurats = JenisSurat::orderBy('nama')->get();

        $penandatangans = Perangkat::with('jabatan')
    ->where('aktif', true)
    ->whereHas('jabatan', function ($q) {
        $q->where('aktif', true);
    })
    ->orderBy('jabatan_id')
    ->orderBy('nama_lengkap')
    ->get();

        return view(
            'admin.pelayanan.permohonan-surat.edit',
            compact(
                'permohonanSurat',
                'penduduks',
                'jenisSurats',
                'penandatangans'
            )
        );
    }

    /**
 * Update the specified resource.
 */
public function update(
    Request $request,
    PermohonanSurat $permohonanSurat
)
{
    $validated = $request->validate([
    'penduduk_id'        => 'nullable|exists:penduduks,id',

    'jenis_surat_id'     => 'required|exists:jenis_surats,id',

    'penandatangan_id'   => 'required|exists:perangkats,id',

    'tanggal_permohonan' => 'required|date',

    'keperluan'          => 'required|string|max:1000',

    'catatan'            => 'nullable|string',
]);

    /*
    |--------------------------------------------------------------------------
    | Data Surat (Khusus Surat Keterangan Usaha)
    |--------------------------------------------------------------------------
    */

    $jenisSurat = JenisSurat::findOrFail(
        $request->jenis_surat_id
    );
/*
|--------------------------------------------------------------------------
| Validasi Surat Keterangan Usaha
|--------------------------------------------------------------------------
*/

if (

    strtoupper($jenisSurat->kode) === 'USAHA'

    ||

    str_contains(
        strtolower($jenisSurat->nama),
        'usaha'
    )

) {

    $request->validate([

        'nama_usaha' => 'required|string|max:150',

        'jenis_usaha' => 'required|string|max:150',

        'alamat_usaha' => 'nullable|string|max:255',

        'lama_usaha' => 'nullable|string|max:100',

    ]);

}
    $dataSurat = [];

switch (strtoupper($jenisSurat->kode)) {

    /*
    |--------------------------------------------------------------------------
    | Surat Keterangan Usaha
    |--------------------------------------------------------------------------
    */

    case 'USAHA':

        $request->validate([

            'nama_usaha'   => 'required|string|max:150',

            'jenis_usaha'  => 'required|string|max:150',

            'alamat_usaha' => 'nullable|string|max:255',

            'lama_usaha'   => 'nullable|string|max:100',

        ]);

        $dataSurat = [

            'nama_usaha'   => $request->nama_usaha,

            'jenis_usaha'  => $request->jenis_usaha,

            'alamat_usaha' => $request->alamat_usaha,

            'lama_usaha'   => $request->lama_usaha,

        ];

        break;

/*
|--------------------------------------------------------------------------
| Surat Keterangan Kematian
|--------------------------------------------------------------------------
*/

case 'KEMATIAN':

    $request->validate([

        'almarhum_id'        => 'required|exists:penduduks,id',
        'pelapor_id'         => 'required|exists:penduduks,id',
        'hari_meninggal'     => 'required|string|max:30',
        'tanggal_meninggal'  => 'required|date',
        'jam_meninggal'      => 'nullable',
        'tempat_meninggal'   => 'required|string|max:150',
        'penyebab_kematian'  => 'required|string|max:255',
        'hubungan_pelapor'   => 'required|string|max:100',

    ]);

    // Almarhum menjadi penduduk utama
    $validated['penduduk_id'] = $request->almarhum_id;

    // Pelapor
    $validated['pelapor_id'] = $request->pelapor_id;

    $dataSurat = [

        'hari_meninggal'     => $request->hari_meninggal,
        'tanggal_meninggal'  => $request->tanggal_meninggal,
        'jam_meninggal'      => $request->jam_meninggal,
        'tempat_meninggal'   => $request->tempat_meninggal,
        'penyebab_kematian'  => $request->penyebab_kematian,
        'hubungan_pelapor'   => $request->hubungan_pelapor,

    ];

    break;



case 'ORANG-SAMA':

    $request->validate([

        'nama_lain' => 'required|string|max:150',

        'jenis_dokumen' => 'required|string|max:150',

        'nomor_dokumen' => 'required|string|max:100',

        'keterangan_perbedaan' => 'nullable|string|max:500',

    ]);


    $dataSurat = [

        'nama_lain' => $request->nama_lain,

        'jenis_dokumen' => $request->jenis_dokumen,

        'nomor_dokumen' => $request->nomor_dokumen,

        'keterangan_perbedaan' => $request->keterangan_perbedaan,

    ];

break;

}

$validated['data_surat'] = $dataSurat;

$permohonanSurat->update($validated);

return redirect()
    ->route('admin.permohonan-surat.index')
    ->with(
        'success',
        'Permohonan surat berhasil diperbarui.'
    );
}

    /**
     * Workflow Status
     */
    public function updateStatus(
        Request $request,
        PermohonanSurat $permohonanSurat
    ) {
        $request->validate([

            'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',

            'catatan' => 'nullable|string|max:1000',

        ]);

        $statusSekarang = $permohonanSurat->status;

        $statusBaru = $request->status;

        $workflow = [

            'Menunggu' => [
                'Diproses',
                'Ditolak',
            ],

            'Diproses' => [
                'Selesai',
            ],

            'Ditolak' => [],

            'Selesai' => [],

        ];

        if (
            !isset($workflow[$statusSekarang]) ||
            !in_array($statusBaru, $workflow[$statusSekarang])
        ) {
            return back()->with(
                'error',
                'Perubahan status tidak diperbolehkan.'
            );
        }

if (
    $statusBaru === 'Selesai' &&
    empty($permohonanSurat->nomor_surat)
) {

    $permohonanSurat->nomor_surat =
        app(NomorSuratService::class)
            ->generate($permohonanSurat);

    $permohonanSurat->save();
}

        $permohonanSurat->update([

            'status' => $statusBaru,

            'catatan' => $request->catatan,

            'tanggal_selesai' => $statusBaru === 'Selesai'
                ? now()
                : $permohonanSurat->tanggal_selesai,

        ]);

        PermohonanSuratHistory::create([

            'permohonan_surat_id' => $permohonanSurat->id,

            'status_lama' => $statusSekarang,

            'status_baru' => $statusBaru,

            'catatan' => $request->catatan,

            'user_id' => Auth::id(),

        ]);

        return redirect()
            ->route(
                'admin.permohonan-surat.show',
                $permohonanSurat
            )
            ->with(
                'success',
                'Status permohonan berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        PermohonanSurat $permohonanSurat
    ) {
        $permohonanSurat->delete();

        return redirect()
            ->route('admin.permohonan-surat.index')
            ->with(
                'success',
                'Permohonan surat berhasil dihapus.'
            );
    }
}