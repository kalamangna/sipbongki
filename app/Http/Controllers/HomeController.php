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
use App\Models\WebsiteSetting;
use App\Models\Halaman;



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





        $agendas = Agenda::where('status','aktif')
            ->orderBy('tanggal')
            ->take(6)
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


        $halamanProfil = Halaman::where('status','aktif')

            ->whereIn('slug',[
                'profil-kelurahan',
                'sejarah',
                'visi-misi',
                'monografi',
                'batas-wilayah',
                'struktur-organisasi'
            ])

            ->get()

            ->keyBy('slug');








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

                'jumlahJenisSurat',

                'jenisSurats',

                'beritas',

                'agendas',

                'galeris',

                'profil',

                'halamanProfil',

                'lingkungans',
                
                'pelayananTerbaru',

                'struktur',
               

            )
        );


    }

/*
|--------------------------------------------------------------------------
| HALAMAN CMS
|--------------------------------------------------------------------------
*/

private function halaman(string $slug)
{
    $profil = WebsiteSetting::first();

    $halaman = Halaman::where('slug', $slug)
        ->where('status', 'aktif')
        ->firstOrFail();

    return view('public.halaman', compact(
        'profil',
        'halaman'
    ));
}

public function profil()
{
    return $this->halaman('profil-kelurahan');
}

public function sejarah()
{
    return $this->halaman('sejarah');
}

public function visiMisi()
{
    return $this->halaman('visi-misi');
}

public function monografi()
{
    return $this->halaman('monografi');
}

public function batasWilayah()
{
    return $this->halaman('batas-wilayah');
}

}