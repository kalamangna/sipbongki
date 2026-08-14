<?php

namespace App\Http\Controllers;


use App\Models\Penduduk;
use App\Models\KartuKeluarga;
use App\Models\Perangkat;
use App\Models\PermohonanSurat;
use App\Models\Lingkungan;
use App\Models\JenisSurat;
use App\Models\Jabatan;

use App\Models\Agenda;
use App\Models\Galeri;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{


    public function index()
    {



        /*
        |--------------------------------------------------------------------------
        | STATISTIK KELURAHAN
        |--------------------------------------------------------------------------
        */


        $jumlahPenduduk = Penduduk::count();


        $jumlahKK = KartuKeluarga::count();


        $jumlahPerangkat = Perangkat::where('aktif', true)
            ->count();


        $jumlahPelayanan = PermohonanSurat::count();


        $jumlahLingkungan = Lingkungan::count();


        $jumlahJenisSurat = JenisSurat::where('aktif', true)
            ->count();

        $lakiLaki = Penduduk::where('jenis_kelamin', 'L')->count();
        $perempuan = Penduduk::where('jenis_kelamin', 'P')->count();

        $pekerjaanStat = Penduduk::selectRaw('pekerjaan as nama, COUNT(*) as total')
            ->whereNotNull('pekerjaan')
            ->where('pekerjaan', '!=', '')
            ->groupBy('pekerjaan')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $agamaStat = Penduduk::selectRaw('agama as nama, COUNT(*) as total')
            ->whereNotNull('agama')
            ->where('agama', '!=', '')
            ->groupBy('agama')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $statusNikahStat = Penduduk::selectRaw('status_perkawinan as nama, COUNT(*) as total')
            ->whereNotNull('status_perkawinan')
            ->where('status_perkawinan', '!=', '')
            ->groupBy('status_perkawinan')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $usiaStat = [
            '0-17' => 0,
            '18-24' => 0,
            '25-34' => 0,
            '35-49' => 0,
            '50+' => 0,
        ];

        foreach (Penduduk::select('tanggal_lahir')->get() as $penduduk) {
            if (!$penduduk->tanggal_lahir) {
                continue;
            }

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

        $pendidikanStat = Penduduk::selectRaw('pendidikan as nama, COUNT(*) as total')
            ->whereNotNull('pendidikan')
            ->where('pendidikan', '!=', '')
            ->groupBy('pendidikan')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

/*
|--------------------------------------------------------------------------
| STATISTIK RT / RW PER LINGKUNGAN
|--------------------------------------------------------------------------
*/

$statistikRtRw = collect([
    [
        'nama' => 'Benteng',
        'rt'   => 10,
        'rw'   => 3,
    ],
    [
        'nama' => 'Paruntu',
        'rt'   => 8,
        'rw'   => 2,
    ],
    [
        'nama' => 'Samaenre',
        'rt'   => 6,
        'rw'   => 3,
    ],
    [
        'nama' => 'Popanda',
        'rt'   => 4,
        'rw'   => 2,
    ],
]);

$jumlahRt = $statistikRtRw->sum('rt');
$jumlahRw = $statistikRtRw->sum('rw');

$statistikLingkungan = Lingkungan::withCount('penduduk')
    ->orderBy('nama')
    ->get();

       



        /*
        |--------------------------------------------------------------------------
        | DATA WEBSITE
        |--------------------------------------------------------------------------
        */


        $jenisSurats = JenisSurat::where('aktif', true)
            ->orderBy('nama')
            ->get();





        $beritas = Berita::where('status','publish')
            ->latest()
            ->take(6)
            ->get();

        $pengumumen = Pengumuman::where('status', 'publish')
        ->orderByDesc('tanggal_publish')
        ->take(6)
        ->get();



        $agendas = Agenda::where('status','aktif')
            ->orderBy('tanggal')
            ->take(9)
            ->get();





        $galeris = Galeri::where('status','aktif')
            ->latest()
            ->take(6)
            ->get();





        /*
        |--------------------------------------------------------------------------
        | WEBSITE SETTING
        |--------------------------------------------------------------------------
        */


        $profil = WebsiteSetting::first();

    

     

        /*
        |--------------------------------------------------------------------------
        | HALAMAN CMS
        |--------------------------------------------------------------------------
        */


        $halamanProfil = [];








/*
|--------------------------------------------------------------------------
| STRUKTUR ORGANISASI
|--------------------------------------------------------------------------
*/

$struktur = Jabatan::query()

    ->aktif()

    ->where('is_struktur', true)

    ->whereNull('parent_id')

    ->with([
        'perangkatStruktur',
        'childrenRecursive'
    ])

    ->orderBy('urutan')

    ->get();

$lingkungans = Lingkungan::withCount('penduduk')
    ->orderBy('nama')
    ->get();
    
        /*
        |--------------------------------------------------------------------------
        | RIWAYAT PELAYANAN
        |--------------------------------------------------------------------------
        */


        $pelayananTerbaru = PermohonanSurat::latest()

            ->take(5)

            ->get();








        return view(
            'public.home',
            compact(


                'jumlahPenduduk',
                'jumlahKK',
                'jumlahPerangkat',
                'jumlahPelayanan',
                'jumlahLingkungan',
                'jumlahRt',
                'jumlahRw',
                'jumlahJenisSurat',
                'lakiLaki',
                'perempuan',
                'pekerjaanStat',
                'agamaStat',
                'statusNikahStat',
                'usiaStat',
                'pendidikanStat',
                'statistikRtRw',
                'jenisSurats',
                'beritas',
                'pengumumen',
                'agendas',
                'galeris',
                'profil',
                'halamanProfil',
                'lingkungans',
                'pelayananTerbaru',
                'struktur',
                'statistikLingkungan',
               

            )
        );


    }

public function showBerita(Berita $berita)
{
    $profil = WebsiteSetting::first();

    $beritaTerbaru = Berita::where('status', 'publish')
        ->where('id', '!=', $berita->id)
        ->latest('tanggal_publish')
        ->take(5)
        ->get();

    return view('public.berita-detail', compact(
        'profil',
        'berita',
        'beritaTerbaru'
    ));
}
public function showPengumuman($slug)
{
    $profil = WebsiteSetting::first();

    $pengumuman = Pengumuman::where('slug', $slug)
        ->where('status', 'publish')
        ->firstOrFail();

    $pengumumanTerbaru = Pengumuman::where('status', 'publish')
        ->where('id', '!=', $pengumuman->id)
        ->orderByDesc('tanggal_publish')
        ->take(5)
        ->get();

    return view('public.pengumuman-detail', compact(
        'profil',
        'pengumuman',
        'pengumumanTerbaru'
    ));
}
public function pengaduan()
{
    $profil = WebsiteSetting::first();

    return view('public.pengaduan', compact('profil'));
}

public function sitemap()
{
    $beritas = Berita::where('status', 'publish')->latest('updated_at')->get();
    $pengumumen = Pengumuman::where('status', 'publish')->latest('updated_at')->get();

    $content = view('public.sitemap', compact('beritas', 'pengumumen'))->render();

    return response($content, 200)
        ->header('Content-Type', 'text/xml');
}

}