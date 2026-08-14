<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\KartuKeluarga;
use App\Models\Lingkungan;
use App\Models\Penduduk;
use App\Models\PermohonanSurat;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendudukExport;
use App\Exports\KartuKeluargaExport;
use App\Exports\PermohonanSuratExport;

class LaporanController extends Controller
{
    /**
     * Dashboard Laporan
     */
    public function index()
    {
        $statistik = [

            'penduduk'   => Penduduk::count(),

            'kk'         => KartuKeluarga::count(),

            'permohonan' => PermohonanSurat::count(),

            'jenis_surat' => JenisSurat::where('aktif', true)->count(),

            'lingkungan' => Lingkungan::count(),

        ];

        return view(
            'admin.laporan.index',
            compact('statistik')
        );
    }

    /**
 * Laporan Penduduk
 */
public function penduduk(Request $request)
{
    $query = Penduduk::with([
    'kartuKeluarga',
    'lingkungan'
]);

/*
|--------------------------------------------------------------------------
| Filter Nama / NIK
|--------------------------------------------------------------------------
*/

if ($request->filled('keyword')) {

    $query->where(function ($q) use ($request) {

        $q->where(
            'nama_lengkap',
            'like',
            '%' . $request->keyword . '%'
        )

        ->orWhere(
            'nik',
            'like',
            '%' . $request->keyword . '%'
        );

    });

}

/*
|--------------------------------------------------------------------------
| Filter Lingkungan
|--------------------------------------------------------------------------
*/

if ($request->filled('lingkungan')) {

    $query->where(
        'lingkungan_id',
        $request->lingkungan
    );

}

/*
|--------------------------------------------------------------------------
| Filter Jenis Kelamin
|--------------------------------------------------------------------------
*/

        if ($request->filled('status')) {
            $query->where('aktif', $request->status === '1');
        }

        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }

        if ($request->filled('rw')) {
            $query->where('rw', $request->rw);
        }

        if ($request->filled('status_perkawinan')) {
            $query->where('status_perkawinan', $request->status_perkawinan);
        }

    $penduduks = $query
        ->orderBy('nama_lengkap')
        ->paginate(20);

    $statistik = [

        'total' => Penduduk::count(),

        'laki' => Penduduk::where(
            'jenis_kelamin',
            'L'
        )->count(),

        'perempuan' => Penduduk::where(
            'jenis_kelamin',
            'P'
        )->count(),

    ];

    $rekapLingkungan = Lingkungan::withCount('penduduk')
        ->orderBy('nama')
        ->get();

    $lingkungans = Lingkungan::orderBy('nama')
        ->get();
    $agamaList = Penduduk::agamaList();
    /*
|--------------------------------------------------------------------------
| Rekap Agama
|--------------------------------------------------------------------------
*/

$rekapAgama = Penduduk::selectRaw('agama, COUNT(*) as total')
    ->groupBy('agama')
    ->orderBy('agama')
    ->get();


/*
|--------------------------------------------------------------------------
| Rekap Pendidikan
|--------------------------------------------------------------------------
*/

$rekapPendidikan = Penduduk::selectRaw('pendidikan, COUNT(*) as total')
    ->groupBy('pendidikan')
    ->orderBy('pendidikan')
    ->get();


/*
|--------------------------------------------------------------------------
| Rekap Pekerjaan
|--------------------------------------------------------------------------
*/

$rekapPekerjaan = Penduduk::selectRaw('pekerjaan, COUNT(*) as total')
    ->groupBy('pekerjaan')
    ->orderBy('pekerjaan')
    ->get();

    return view(
    'admin.laporan.penduduk',
    compact(
        'penduduks',
        'statistik',
        'rekapLingkungan',
        'rekapAgama',
        'rekapPendidikan',
        'rekapPekerjaan',
        'lingkungans',
        'agamaList'
    )
);
}

    /**
 * Laporan Kartu Keluarga
 */
public function kartuKeluarga(Request $request)
{
    $query = KartuKeluarga::with([
        'kepalaKeluarga',
        'lingkungan',
    ])
    ->withCount('anggota');

    /*
    |--------------------------------------------------------------------------
    | Filter Nomor KK / Kepala Keluarga
    |--------------------------------------------------------------------------
    */

    if ($request->filled('keyword')) {

        $keyword = $request->keyword;

        $query->where(function ($q) use ($keyword) {

            $q->where('no_kk', 'like', "%{$keyword}%")

            ->orWhereHas('kepalaKeluarga', function ($qq) use ($keyword) {

                $qq->where(
                    'nama_lengkap',
                    'like',
                    "%{$keyword}%"
                );

            });

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Lingkungan
    |--------------------------------------------------------------------------
    */

    if ($request->filled('lingkungan')) {

        $query->where(
            'lingkungan_id',
            $request->lingkungan
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter RT
    |--------------------------------------------------------------------------
    */

    if ($request->filled('rt')) {

        $query->where(
            'rt',
            $request->rt
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter RW
    |--------------------------------------------------------------------------
    */

    if ($request->filled('rw')) {

        $query->where(
            'rw',
            $request->rw
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Status
    |--------------------------------------------------------------------------
    */

    if ($request->filled('status')) {

        $query->where(
            'aktif',
            $request->status
        );

    }

    $kartuKeluargas = $query
        ->orderBy('no_kk')
        ->paginate(20)
        ->withQueryString();

    /*
    |--------------------------------------------------------------------------
    | Statistik
    |--------------------------------------------------------------------------
    */

    $statistik = [

        'total_kk' => KartuKeluarga::count(),

        'total_anggota' => Penduduk::count(),

        'kk_aktif' => KartuKeluarga::where(
            'aktif',
            true
        )->count(),

        'rata_anggota' => round(
            Penduduk::count() /
            max(KartuKeluarga::count(), 1),
            2
        ),

    ];

    /*
    |--------------------------------------------------------------------------
    | Rekap Lingkungan
    |--------------------------------------------------------------------------
    */

    $rekapLingkungan = Lingkungan::withCount([
        'kartuKeluargas',
        'penduduk',
    ])
    ->orderBy('nama')
    ->get();

    /*
    |--------------------------------------------------------------------------
    | Data Filter
    |--------------------------------------------------------------------------
    */

    $lingkungans = Lingkungan::orderBy('nama')->get();

    return view(
        'admin.laporan.kartu-keluarga',
        compact(
            'kartuKeluargas',
            'statistik',
            'rekapLingkungan',
            'lingkungans'
        )
    );
}

public function showKartuKeluarga(KartuKeluarga $kartuKeluarga)
{
    $kartuKeluarga->load([
        'kepalaKeluarga',
        'lingkungan',
        'anggota'
    ]);

    return view(
        'admin.laporan.show-kartu-keluarga',
        compact('kartuKeluarga')
    );
}

public function persuratan(Request $request)
{
    $query = PermohonanSurat::with([
        'penduduk',
        'jenisSurat',
        'penandatangan.jabatan'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Filter Keyword
    |--------------------------------------------------------------------------
    */

    if ($request->filled('keyword')) {

        $keyword = $request->keyword;

        $query->where(function ($q) use ($keyword) {

            $q->where('nomor_permohonan', 'like', "%{$keyword}%")
              ->orWhere('nomor_surat', 'like', "%{$keyword}%")
              ->orWhereHas('penduduk', function ($qq) use ($keyword) {

                    $qq->where('nama_lengkap', 'like', "%{$keyword}%")
                       ->orWhere('nik', 'like', "%{$keyword}%");

              });

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Jenis Surat
    |--------------------------------------------------------------------------
    */

    if ($request->filled('jenis_surat')) {

        $query->where(
            'jenis_surat_id',
            $request->jenis_surat
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Status
    |--------------------------------------------------------------------------
    */

    if ($request->filled('status')) {

        $query->where(
            'status',
            $request->status
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Tanggal
    |--------------------------------------------------------------------------
    */

    if ($request->filled('tanggal_awal')) {

        $query->whereDate(
            'tanggal_permohonan',
            '>=',
            $request->tanggal_awal
        );

    }

    if ($request->filled('tanggal_akhir')) {

        $query->whereDate(
            'tanggal_permohonan',
            '<=',
            $request->tanggal_akhir
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Data
    |--------------------------------------------------------------------------
    */

    $permohonans = $query
        ->latest('tanggal_permohonan')
        ->paginate(20)
        ->withQueryString();

    /*
    |--------------------------------------------------------------------------
    | Statistik
    |--------------------------------------------------------------------------
    */

    $statistik = [

        'total' => PermohonanSurat::count(),

        'menunggu' => PermohonanSurat::where(
            'status',
            'Menunggu'
        )->count(),

        'diproses' => PermohonanSurat::where(
            'status',
            'Diproses'
        )->count(),

        'selesai' => PermohonanSurat::where(
            'status',
            'Selesai'
        )->count(),

        'ditolak' => PermohonanSurat::where(
            'status',
            'Ditolak'
        )->count(),

    ];

    /*
    |--------------------------------------------------------------------------
    | Jenis Surat
    |--------------------------------------------------------------------------
    */

    $jenisSurats = JenisSurat::where(
        'aktif',
        true
    )
    ->orderBy('nama')
    ->get();

    /*
    |--------------------------------------------------------------------------
    | Rekap Jenis Surat
    |--------------------------------------------------------------------------
    */

    $rekapJenis = JenisSurat::withCount('permohonanSurats')
        ->where('aktif', true)
        ->orderBy('nama')
        ->get();

    return view(
        'admin.laporan.persuratan',
        compact(
            'permohonans',
            'statistik',
            'jenisSurats',
            'rekapJenis'
        )
    );
}

public function showPersuratan(PermohonanSurat $permohonanSurat)
{
    $permohonanSurat->load([
        'penduduk',
        'jenisSurat',
        'penandatangan.jabatan',
    ]);

    return view(
        'admin.laporan.show-persuratan',
        compact('permohonanSurat')
    );
}

    /**
     * Laporan Statistik (berdasarkan statistik publik)
     */
    public function statistik()
    {
        // pekerjaan, agama, status nikah, pendidikan, usia, rt/rw per lingkungan
        $pekerjaanStat = Penduduk::selectRaw('pekerjaan as nama, COUNT(*) as total')
            ->whereNotNull('pekerjaan')
            ->where('pekerjaan', '!=', '')
            ->groupBy('pekerjaan')
            ->orderByDesc('total')
            ->get();

        $agamaStat = Penduduk::selectRaw('agama as nama, COUNT(*) as total')
            ->whereNotNull('agama')
            ->where('agama', '!=', '')
            ->groupBy('agama')
            ->orderByDesc('total')
            ->get();

        $statusNikahStat = Penduduk::selectRaw('status_perkawinan as nama, COUNT(*) as total')
            ->whereNotNull('status_perkawinan')
            ->where('status_perkawinan', '!=', '')
            ->groupBy('status_perkawinan')
            ->orderByDesc('total')
            ->get();

        $pendidikanStat = Penduduk::selectRaw('pendidikan as nama, COUNT(*) as total')
            ->whereNotNull('pendidikan')
            ->where('pendidikan', '!=', '')
            ->groupBy('pendidikan')
            ->orderByDesc('total')
            ->get();

        // usia buckets
        $usiaStat = [
            '0-17' => 0,
            '18-24' => 0,
            '25-34' => 0,
            '35-49' => 0,
            '50+' => 0,
        ];

        foreach (Penduduk::select('tanggal_lahir')->get() as $penduduk) {
            if (!$penduduk->tanggal_lahir) continue;
            $umur = $penduduk->tanggal_lahir->age;
            if ($umur <= 17) {
                $usiaStat['0-17']++;
            } elseif ($umur <= 24) {
                $usiaStat['18-24']++;
            } elseif ($umur <= 34) {
                $usiaStat['25-34']++;
            } elseif ($umur <= 49) {
                $usiaStat['35-49']++;
            } else {
                $usiaStat['50+']++;
            }
        }

        // Statistik penduduk berdasarkan lingkungan
        $statistikLingkungan = Lingkungan::withCount('penduduk')
            ->orderBy('nama')
            ->get();

        // Ringkasan metrik
        $totalPenduduk = Penduduk::count();
        $totalLaki = Penduduk::where('jenis_kelamin', 'L')->count();
        $totalPerempuan = Penduduk::where('jenis_kelamin', 'P')->count();
        $totalKK = KartuKeluarga::count();

        return view('admin.laporan.statistik', compact(
            'totalPenduduk',
            'totalLaki',
            'totalPerempuan',
            'totalKK',
            'pekerjaanStat',
            'agamaStat',
            'statusNikahStat',
            'pendidikanStat',
            'usiaStat',
            'statistikLingkungan'
        ));
    }
    /**
 * Export Penduduk Excel
 */
public function exportPenduduk()
{
    return Excel::download(
        new PendudukExport,
        'laporan-penduduk.xlsx'
    );
}
public function printPenduduk(Request $request)
{
    $query = Penduduk::with([
        'kartuKeluarga',
        'lingkungan'
    ]);


    if ($request->filled('keyword')) {

        $query->where(function($q) use ($request){

            $q->where(
                'nama_lengkap',
                'like',
                '%' . $request->keyword . '%'
            )
            ->orWhere(
                'nik',
                'like',
                '%' . $request->keyword . '%'
            );

        });

    }


    if ($request->filled('lingkungan')) {

        $query->where(
            'lingkungan_id',
            $request->lingkungan
        );

    }


        if ($request->filled('status')) {
            $query->where('aktif', $request->status === '1');
        }

        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }

        if ($request->filled('rw')) {
            $query->where('rw', $request->rw);
        }

        if ($request->filled('status_perkawinan')) {
            $query->where('status_perkawinan', $request->status_perkawinan);
        }


    $penduduks = $query
        ->orderBy('nama_lengkap')
        ->get();


    return view(
        'admin.laporan.print-penduduk',
        compact('penduduks')
    );
}
/**
 * Print Laporan Kartu Keluarga
 */
public function printKartuKeluarga(Request $request)
{
    $query = KartuKeluarga::with([
        'kepalaKeluarga',
        'lingkungan',
    ])->withCount('anggota');

    if ($request->filled('keyword')) {

        $keyword = $request->keyword;

        $query->where(function ($q) use ($keyword) {

            $q->where('no_kk', 'like', "%{$keyword}%")
              ->orWhereHas('kepalaKeluarga', function ($qq) use ($keyword) {

                  $qq->where(
                      'nama_lengkap',
                      'like',
                      "%{$keyword}%"
                  );

              });

        });

    }

    if ($request->filled('lingkungan')) {
        $query->where('lingkungan_id', $request->lingkungan);
    }

    if ($request->filled('rt')) {
        $query->where('rt', $request->rt);
    }

    if ($request->filled('rw')) {
        $query->where('rw', $request->rw);
    }

    if ($request->filled('status')) {
        $query->where('aktif', $request->status);
    }

    $kartuKeluargas = $query
        ->orderBy('no_kk')
        ->get();

    return view(
        'admin.laporan.print-kartu-keluarga',
        compact('kartuKeluargas')
    );
}
/**
 * Print Laporan Persuratan
 */
public function printPersuratan(Request $request)
{
    $query = PermohonanSurat::with([
        'penduduk',
        'jenisSurat',
        'penandatangan.jabatan',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Filter Keyword
    |--------------------------------------------------------------------------
    */

    if ($request->filled('keyword')) {

        $keyword = $request->keyword;

        $query->where(function ($q) use ($keyword) {

            $q->where('nomor_permohonan', 'like', "%{$keyword}%")
              ->orWhere('nomor_surat', 'like', "%{$keyword}%")
              ->orWhereHas('penduduk', function ($qq) use ($keyword) {

                    $qq->where(
                        'nama_lengkap',
                        'like',
                        "%{$keyword}%"
                    )
                    ->orWhere(
                        'nik',
                        'like',
                        "%{$keyword}%"
                    );

              });

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Jenis Surat
    |--------------------------------------------------------------------------
    */

    if ($request->filled('jenis_surat')) {

        $query->where(
            'jenis_surat_id',
            $request->jenis_surat
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Status
    |--------------------------------------------------------------------------
    */

    if ($request->filled('status')) {

        $query->where(
            'status',
            $request->status
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Filter Tanggal
    |--------------------------------------------------------------------------
    */

    if ($request->filled('tanggal_awal')) {

        $query->whereDate(
            'tanggal_permohonan',
            '>=',
            $request->tanggal_awal
        );

    }

    if ($request->filled('tanggal_akhir')) {

        $query->whereDate(
            'tanggal_permohonan',
            '<=',
            $request->tanggal_akhir
        );

    }

    $permohonans = $query
        ->latest('tanggal_permohonan')
        ->get();

    return view(
        'admin.laporan.print-persuratan',
        compact('permohonans')
    );
}
/**
 * Export Kartu Keluarga Excel
 */
public function exportKartuKeluarga()
{
    return Excel::download(
        new KartuKeluargaExport,
        'laporan-kartu-keluarga.xlsx'
    );
}


/**
 * Export Permohonan Surat Excel
 */
public function exportPersuratan()
{
    return Excel::download(
        new PermohonanSuratExport,
        'laporan-persuratan.xlsx'
    );
}
}