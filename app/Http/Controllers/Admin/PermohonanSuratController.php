<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\Penduduk;
use App\Models\Lingkungan;
use App\Models\PermohonanSurat;
use App\Models\PermohonanSuratHistory;
use App\Models\Perangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
        $jenis_surat_id = $request->jenis_surat_id;
        $status = $request->status;
        $jenis_pemohon = $request->jenis_pemohon;

        $permohonans = PermohonanSurat::with([
                'penduduk',
                'jenisSurat',
                'penandatangan.jabatan',
            ])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nomor_permohonan', 'like', "%{$search}%")
                      ->orWhereHas('penduduk', function ($subq) use ($search) {
                          $subq->where('nama_lengkap', 'like', "%{$search}%")
                               ->orWhere('nik', 'like', "%{$search}%");
                      })
                      ->orWhere('data_surat->manual_nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('data_surat->nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('data_surat->manual_nik', 'like', "%{$search}%")
                      ->orWhere('data_surat->nik', 'like', "%{$search}%");
                });
            })
            ->when($jenis_surat_id, function ($query) use ($jenis_surat_id) {
                $query->where('jenis_surat_id', $jenis_surat_id);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($jenis_pemohon, function ($query) use ($jenis_pemohon) {
                if ($jenis_pemohon === 'bongki') {
                    $query->whereNotNull('penduduk_id');
                } elseif ($jenis_pemohon === 'luar') {
                    $query->whereNull('penduduk_id');
                }
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $jenisSurats = JenisSurat::orderBy('nama')->get();

        $stats = [
            'menunggu' => PermohonanSurat::where('status', 'Menunggu')->count(),
            'diproses' => PermohonanSurat::where('status', 'Diproses')->count(),
            'selesai' => PermohonanSurat::where('status', 'Selesai')->count(),
            'ditolak' => PermohonanSurat::where('status', 'Ditolak')->count(),
        ];

        return view(
            'admin.pelayanan.permohonan-surat.index',
            compact(
                'permohonans',
                'search',
                'jenis_surat_id',
                'status',
                'jenis_pemohon',
                'jenisSurats',
                'stats'
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
        $q->where('aktif', true)->where('is_penandatangan', true);
    })
    ->orderBy('jabatan_id')
    ->orderBy('nama_lengkap')
    ->get();

        $lingkungans = Lingkungan::orderBy('nama')->get();

        return view(
            'admin.pelayanan.permohonan-surat.create',
            compact(
                'penduduks',
                'jenisSurats',
                'penandatangans',
                'lingkungans'
            )
        );
    }

    private function isDomisiliJenisSurat(JenisSurat $jenisSurat): bool
    {
        return strtoupper($jenisSurat->kode) === 'DOMISILI'
            || strtoupper($jenisSurat->kode) === 'SK-002'
            || str_contains(strtolower($jenisSurat->nama), 'domisili');
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
        'keterangan_usaha' => 'nullable|string|max:255',

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
            'keterangan_usaha' => 'nullable|string|max:255',
        ]);

        $dataSurat = [
            'nama_usaha'   => $request->nama_usaha,
            'jenis_usaha'  => $request->jenis_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'lama_usaha'   => $request->lama_usaha,
            'keterangan_usaha' => $request->keterangan_usaha,
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

    case 'DOMISILI':
    case 'SK-002':

    $request->validate([

        'nama_lengkap'          => 'required|string|max:150',
        'nik'                   => 'required|string|max:30',
        'tempat_lahir'          => 'required|string|max:100',
        'tanggal_lahir'         => 'required|date',
        'jenis_kelamin'         => 'required|in:L,P',
        'agama'                 => 'required|string|max:50',
        'pekerjaan'             => 'required|string|max:100',
        'telepon'               => 'nullable|string|max:30',

        'rt'                    => 'required|string|max:5',
        'rw'                    => 'required|string|max:5',
        'lama_tinggal'          => 'required|string|max:100',
        'status_tempat_tinggal' => 'required|string|max:100',

        'alamat_asal'           => 'required|string|max:500',
        'alamat'                => 'required|string|max:500',

    ]);

    $dataSurat = [

        'nama_lengkap'          => $request->nama_lengkap,
        'nik'                   => $request->nik,
        'tempat_lahir'          => $request->tempat_lahir,
        'tanggal_lahir'         => $request->tanggal_lahir,
        'jenis_kelamin'         => $request->jenis_kelamin,
        'agama'                 => $request->agama,
        'pekerjaan'             => $request->pekerjaan,
        'telepon'               => $request->telepon,

        'rt'                    => $request->rt,
        'rw'                    => $request->rw,
        'lama_tinggal'          => $request->lama_tinggal,
        'status_tempat_tinggal' => $request->status_tempat_tinggal,

        'alamat_asal'           => $request->alamat_asal,
        'alamat'                => $request->alamat,

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
        'PMH-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(5));

    $validated['status'] = 'Menunggu';

    $manualFields = $request->only([
        'manual_nama_lengkap', 'manual_nik', 'manual_tempat_lahir', 'manual_tanggal_lahir',
        'manual_jenis_kelamin', 'manual_agama', 'manual_pekerjaan', 'manual_alamat',
        'manual_rt', 'manual_rw', 'manual_no_kk'
    ]);

    $uploadedFiles = [];
    $docs = ['dokumen_ktp', 'dokumen_kk', 'dokumen_surat_pengantar', 'dokumen_tempat_usaha'];
    foreach ($docs as $doc) {
        if ($request->hasFile($doc)) {
            $request->validate([$doc => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:2048']]);
            $uploadedFiles[$doc] = $request->file($doc)->store('permohonan-surat/dokumen', 'local');
        }
    }
    
    $validated['data_surat'] = array_merge($dataSurat, $manualFields, $uploadedFiles);

    if (empty($validated['penduduk_id']) && empty($request->manual_nama_lengkap)) {
        return back()
            ->withInput()
            ->withErrors([
                'penduduk_id' => 'Penduduk atau Nama Pemohon (Manual) harus diisi.'
            ]);
    }

    $validated['operator_id'] = Auth::id();

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
            'operator',
            'histories.user',

        ]);

        $penandatangans = \App\Models\Perangkat::with('jabatan')
            ->where('aktif', true)
            ->whereHas('jabatan', function ($q) {
                $q->where('aktif', true)->where('is_penandatangan', true);
            })
            ->orderBy('jabatan_id')
            ->orderBy('nama_lengkap')
            ->get();

        return view(
            'admin.pelayanan.permohonan-surat.show',
            compact('permohonanSurat', 'penandatangans')
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
        $q->where('aktif', true)->where('is_penandatangan', true);
    })
    ->orderBy('jabatan_id')
    ->orderBy('nama_lengkap')
    ->get();

        $lingkungans = Lingkungan::orderBy('nama')->get();

        return view(
            'admin.pelayanan.permohonan-surat.edit',
            compact(
                'permohonanSurat',
                'penduduks',
                'jenisSurats',
                'penandatangans',
                'lingkungans'
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

    $jenisSurat = JenisSurat::findOrFail(
        $request->jenis_surat_id
    );

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
                'keterangan_usaha' => 'nullable|string|max:255',

            ]);

            $dataSurat = [

                'nama_usaha'   => $request->nama_usaha,
                'jenis_usaha'  => $request->jenis_usaha,
                'alamat_usaha' => $request->alamat_usaha,
                'lama_usaha'   => $request->lama_usaha,
                'keterangan_usaha' => $request->keterangan_usaha,

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

            $validated['penduduk_id'] = $request->almarhum_id;
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

        /*
        |--------------------------------------------------------------------------
        | Surat Keterangan Orang Yang Sama
        |--------------------------------------------------------------------------
        */

        case 'ORANG-SAMA':

            $request->validate([

                'nama_lain'              => 'required|string|max:150',
                'jenis_dokumen'          => 'required|string|max:150',
                'nomor_dokumen'          => 'required|string|max:100',
                'keterangan_perbedaan'   => 'nullable|string|max:500',

            ]);

            $dataSurat = [

                'nama_lain'             => $request->nama_lain,
                'jenis_dokumen'         => $request->jenis_dokumen,
                'nomor_dokumen'         => $request->nomor_dokumen,
                'keterangan_perbedaan'  => $request->keterangan_perbedaan,

            ];

            break;

        /*
        |--------------------------------------------------------------------------
        | Surat Keterangan Domisili
        |--------------------------------------------------------------------------
        */

        case 'DOMISILI':
        case 'SK-002':

            $request->validate([

                'nama_lengkap'            => 'required|string|max:150',
                'nik'                     => 'required|string|max:30',
                'tempat_lahir'            => 'required|string|max:100',
                'tanggal_lahir'           => 'required|date',
                'jenis_kelamin'           => 'required|in:L,P',
                'agama'                   => 'required|string|max:50',
                'pekerjaan'               => 'required|string|max:100',
                'telepon'                 => 'nullable|string|max:30',

                'rt'                      => 'required|string|max:5',
                'rw'                      => 'required|string|max:5',
                'lama_tinggal'            => 'required|string|max:100',
                'status_tempat_tinggal'   => 'required|string|max:100',
                'alamat_asal'             => 'required|string|max:500',

                'alamat'                  => 'required|string|max:500',

            ]);

            $dataSurat = [

                'nama_lengkap'            => $request->nama_lengkap,
                'nik'                     => $request->nik,
                'tempat_lahir'            => $request->tempat_lahir,
                'tanggal_lahir'           => $request->tanggal_lahir,
                'jenis_kelamin'           => $request->jenis_kelamin,
                'agama'                   => $request->agama,
                'pekerjaan'               => $request->pekerjaan,
                'telepon'                 => $request->telepon,

                'rt'                      => $request->rt,
                'rw'                      => $request->rw,
                'lama_tinggal'            => $request->lama_tinggal,
                'status_tempat_tinggal'   => $request->status_tempat_tinggal,
                'alamat_asal'             => $request->alamat_asal,

                'alamat'                  => $request->alamat,

            ];

            break;
    }

    $manualFields = $request->only([
        'manual_nama_lengkap', 'manual_nik', 'manual_tempat_lahir', 'manual_tanggal_lahir',
        'manual_jenis_kelamin', 'manual_agama', 'manual_pekerjaan', 'manual_alamat',
        'manual_rt', 'manual_rw', 'manual_no_kk'
    ]);

    $uploadedFiles = [];
    $docs = ['dokumen_ktp', 'dokumen_kk', 'dokumen_surat_pengantar', 'dokumen_tempat_usaha'];
    foreach ($docs as $doc) {
        if ($request->hasFile($doc)) {
            $request->validate([$doc => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:2048']]);
            $uploadedFiles[$doc] = $request->file($doc)->store('permohonan-surat/dokumen', 'local');

            if (!empty($permohonanSurat->data_surat[$doc])) {
                // Coba hapus dari disk local dulu, fallback ke public (file lama)
                $oldPath = $permohonanSurat->data_surat[$doc];
                if (\Illuminate\Support\Facades\Storage::disk('local')->exists($oldPath)) {
                    \Illuminate\Support\Facades\Storage::disk('local')->delete($oldPath);
                } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($oldPath)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
                }
            }
        }
    }

    
    // Merge existing data_surat so we don't lose them if they are omitted in request, then overlay new ones
    $validated['data_surat'] = array_merge($permohonanSurat->data_surat ?? [], $dataSurat, $manualFields, $uploadedFiles);

    $permohonanSurat->update($validated);

    return redirect()
        ->route('admin.permohonan-surat.index')
        ->with('success', 'Permohonan surat berhasil diperbarui.');
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
        ], [
            'status.required' => 'Status permohonan wajib dipilih.',
            'status.in' => 'Status permohonan tidak valid.',
            'catatan.max' => 'Catatan pelayanan maksimal 1000 karakter.',
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

        if (($statusBaru === 'Diproses' || $statusBaru === 'Selesai') && empty($permohonanSurat->penandatangan_id)) {
            return back()->with('error', 'Pejabat penandatangan belum dipilih. Silakan pilih penandatangan terlebih dahulu.');
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
     * Update note only.
     */
    public function updateNote(
        Request $request,
        PermohonanSurat $permohonanSurat
    ) {
        $request->validate([
            'catatan' => 'nullable|string|max:1000',
        ], [
            'catatan.max' => 'Catatan pelayanan maksimal 1000 karakter.',
        ]);

        $permohonanSurat->update([
            'catatan' => $request->catatan,
        ]);

        PermohonanSuratHistory::create([
            'permohonan_surat_id' => $permohonanSurat->id,
            'status_lama' => $permohonanSurat->status,
            'status_baru' => $permohonanSurat->status,
            'catatan' => $request->catatan,
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.permohonan-surat.show', $permohonanSurat)
            ->with('success', 'Catatan pelayanan berhasil diperbarui.');
    }

    /**
     * Update penandatangan surat.
     */
    public function updatePenandatangan(
        Request $request,
        PermohonanSurat $permohonanSurat
    ) {
        $request->validate([
            'penandatangan_id' => 'required|exists:perangkats,id',
        ]);

        $permohonanSurat->update([
            'penandatangan_id' => $request->penandatangan_id,
        ]);

        return redirect()
            ->route('admin.permohonan-surat.show', $permohonanSurat)
            ->with('success', 'Pejabat penandatangan berhasil dipilih.');
    }

    /**
     * Tampilkan atau unduh dokumen permohonan secara aman.
     */
    public function viewDocument(PermohonanSurat $permohonanSurat, string $jenis)
    {
        $allowedDocs = ['dokumen_ktp', 'dokumen_kk', 'dokumen_surat_pengantar', 'dokumen_tempat_usaha'];
        if (!in_array($jenis, $allowedDocs, true)) {
            abort(404, 'Jenis dokumen tidak valid.');
        }

        $filePath = data_get($permohonanSurat->data_surat, $jenis);
        if (empty($filePath)) {
            abort(404, 'Dokumen belum diunggah.');
        }

        // Cek di disk local (private)
        if (\Illuminate\Support\Facades\Storage::disk('local')->exists($filePath)) {
            return response()->file(\Illuminate\Support\Facades\Storage::disk('local')->path($filePath), [
                'X-Content-Type-Options' => 'nosniff',
                'Cache-Control' => 'private, no-cache, no-store, must-revalidate',
            ]);
        }

        // Fallback cek di disk public (legacy upload)
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($filePath)) {
            return response()->file(\Illuminate\Support\Facades\Storage::disk('public')->path($filePath), [
                'X-Content-Type-Options' => 'nosniff',
                'Cache-Control' => 'private, no-cache, no-store, must-revalidate',
            ]);
        }

        abort(404, 'Berkas fisik dokumen tidak ditemukan di server.');
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