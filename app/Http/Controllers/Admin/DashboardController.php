<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\KartuKeluarga;
use App\Models\Perangkat;
use App\Models\Jabatan;
use App\Models\Lingkungan;
use App\Models\JenisSurat;
use App\Models\PermohonanSurat;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Statistik Utama
        |--------------------------------------------------------------------------
        */

        $totalPenduduk = Penduduk::count();
        $totalKK = KartuKeluarga::count();
        $totalPerangkat = Perangkat::count();
        $totalPermohonan = PermohonanSurat::count();

        /*
        |--------------------------------------------------------------------------
        | Referensi
        |--------------------------------------------------------------------------
        */

        $totalJabatan = Jabatan::count();
        $totalLingkungan = Lingkungan::count();
        $totalJenisSurat = JenisSurat::count();

        /*
        |--------------------------------------------------------------------------
        | Aparatur
        |--------------------------------------------------------------------------
        */

        $perangkatAktif = Perangkat::where('aktif', true)->count();

        /*
        |--------------------------------------------------------------------------
        | Statistik Penduduk
        |--------------------------------------------------------------------------
        */

        $lakiLaki = Penduduk::where('jenis_kelamin', 'L')->count();
        $perempuan = Penduduk::where('jenis_kelamin', 'P')->count();

        $aktif = Penduduk::where('aktif', true)->count();
        $nonAktif = Penduduk::where('aktif', false)->count();

        /*
        |--------------------------------------------------------------------------
        | Statistik Surat
        |--------------------------------------------------------------------------
        */

        $suratHariIni = PermohonanSurat::whereDate(
            'created_at',
            today()
        )->count();

        $suratDiproses = PermohonanSurat::where(
            'status',
            'Diproses'
        )->count();

        $suratSelesai = PermohonanSurat::where(
            'status',
            'Selesai'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Data Lingkungan
        |--------------------------------------------------------------------------
        */

        $lingkungan = Lingkungan::withCount('penduduk')
            ->orderBy('nama')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Data Terbaru
        |--------------------------------------------------------------------------
        */

        $pendudukTerbaru = Penduduk::with('lingkungan')
            ->latest()
            ->take(5)
            ->get();

        $permohonanTerbaru = PermohonanSurat::with([
                'penduduk',
                'jenisSurat'
            ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Chart Jenis Kelamin
        |--------------------------------------------------------------------------
        */

        $chartJK = [
            'labels' => [
                'Laki-laki',
                'Perempuan'
            ],
            'data' => [
                $lakiLaki,
                $perempuan
            ]
        ];

        /*
        |--------------------------------------------------------------------------
        | Chart Status Permohonan
        |--------------------------------------------------------------------------
        */

        $chartPelayanan = [
            'labels' => [
                'Menunggu',
                'Diproses',
                'Selesai',
                'Ditolak'
            ],
            'data' => [
                PermohonanSurat::where('status','Menunggu')->count(),
                PermohonanSurat::where('status','Diproses')->count(),
                PermohonanSurat::where('status','Selesai')->count(),
                PermohonanSurat::where('status','Ditolak')->count(),
            ]
        ];

        /*
        |--------------------------------------------------------------------------
        | Chart Permohonan Bulanan
        |--------------------------------------------------------------------------
        */

        $chartBulanan = [
            'labels' => [],
            'data'   => [],
        ];

        for ($i = 1; $i <= 12; $i++) {

            $chartBulanan['labels'][] = date(
                'M',
                mktime(0,0,0,$i,1)
            );

            $chartBulanan['data'][] =
                PermohonanSurat::whereYear(
                    'created_at',
                    now()->year
                )
                ->whereMonth(
                    'created_at',
                    $i
                )
                ->count();
        }

        /*
        |--------------------------------------------------------------------------
        | Chart Penduduk per Lingkungan
        |--------------------------------------------------------------------------
        */

        $chartLingkungan = [
            'labels' => $lingkungan->pluck('nama'),
            'data'   => $lingkungan->pluck('penduduk_count'),
        ];

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard.dashboard',
            compact(
                'totalPenduduk',
                'totalKK',
                'totalPerangkat',
                'totalPermohonan',

                'totalJabatan',
                'totalLingkungan',
                'totalJenisSurat',

                'perangkatAktif',

                'lakiLaki',
                'perempuan',

                'aktif',
                'nonAktif',

                'suratHariIni',
                'suratDiproses',
                'suratSelesai',

                'lingkungan',

                'pendudukTerbaru',
                'permohonanTerbaru',

                'chartJK',
                'chartPelayanan',
                'chartBulanan',
                'chartLingkungan'
            )
        );
    }
}