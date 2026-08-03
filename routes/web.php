<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LingkunganController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\JenisSuratController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\KartuKeluargaController;
use App\Http\Controllers\Admin\PerangkatController;
use App\Http\Controllers\Admin\PermohonanSuratController;
use App\Http\Controllers\Admin\SuratController;
use App\Http\Controllers\Admin\RiwayatPelayananController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\Website\PengumumanController;
use App\Http\Controllers\Admin\PengaduanController;

use App\Http\Controllers\PublicPengaduanController;

use App\Http\Controllers\Operator\DashboardController as OperatorDashboardController;
use App\Http\Controllers\Operator\PendudukController as OperatorPendudukController;
use App\Http\Controllers\Operator\KartuKeluargaController as OperatorKartuKeluargaController;
use App\Http\Controllers\Operator\PermohonanSuratController as OperatorPermohonanSuratController;
use App\Http\Controllers\Operator\RiwayatPelayananController as OperatorRiwayatPelayananController;
use App\Http\Controllers\Operator\LaporanController as OperatorLaporanController;

use App\Http\Controllers\Admin\Website\BeritaController;
use App\Http\Controllers\Admin\Website\AgendaController;
use App\Http\Controllers\Admin\Website\GaleriController;
use App\Http\Controllers\Admin\Website\HalamanController;
use App\Http\Controllers\Admin\Website\WebsiteSettingController;

use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Halaman Awal
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/berita/{berita}', [HomeController::class, 'showBerita'])
    ->name('berita.show');

    Route::get('/pengumuman/{slug}', 
    [HomeController::class, 'showPengumuman']
)->name('pengumuman.detail');

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/berita/{berita}', [HomeController::class, 'showBerita'])
    ->name('berita.show');

Route::get(
    '/pengumuman/{slug}',
    [HomeController::class, 'showPengumuman']
)->name('pengumuman.detail');

/*
|--------------------------------------------------------------------------
| Pengaduan
|--------------------------------------------------------------------------
*/

Route::get('/pengaduan', [HomeController::class, 'pengaduan'])
    ->name('pengaduan');

Route::post('/pengaduan',
    [PublicPengaduanController::class, 'store']
)->name('pengaduan.store');

/*
|--------------------------------------------------------------------------
| Dashboard Breeze
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Administrator
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            'dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Master Data
        |--------------------------------------------------------------------------
        */

        Route::resource('lingkungan', LingkunganController::class);

        Route::resource('jabatan', JabatanController::class);

        Route::resource('jenis-surat', JenisSuratController::class);


        /*
        |--------------------------------------------------------------------------
        | Kependudukan
        |--------------------------------------------------------------------------
        */

        Route::resource('penduduk', PendudukController::class);

        Route::resource('kartu-keluarga', KartuKeluargaController::class);

        Route::resource('perangkat', PerangkatController::class);


        /*
        |--------------------------------------------------------------------------
        | Pelayanan Surat
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'permohonan-surat',
            PermohonanSuratController::class
        );

        /*
|--------------------------------------------------------------------------
| Pengaduan Masyarakat
|--------------------------------------------------------------------------
*/

Route::resource(
    'pengaduan',
    PengaduanController::class
);

        /*
        |--------------------------------------------------------------------------
        | Workflow Permohonan Surat
        |--------------------------------------------------------------------------
        */

        Route::patch(
            'permohonan-surat/{permohonanSurat}/status',
            [PermohonanSuratController::class, 'updateStatus']
        )->name('permohonan-surat.update-status');


        /*
        |--------------------------------------------------------------------------
        | Preview Surat
        |--------------------------------------------------------------------------
        */

        Route::get(
            'permohonan-surat/{permohonanSurat}/preview',
            [PermohonanSuratController::class, 'preview']
        )->name('permohonan-surat.preview');

        Route::get(
            'permohonan-surat/{permohonanSurat}/print',
            [PermohonanSuratController::class, 'print']
        )->name('permohonan-surat.print');


        /*
        |--------------------------------------------------------------------------
        | Riwayat Pelayanan
        |--------------------------------------------------------------------------
        */

        Route::get(
            'riwayat-pelayanan',
            [RiwayatPelayananController::class, 'index']
        )->name('riwayat-pelayanan.index');

/*
|--------------------------------------------------------------------------
| Laporan
|--------------------------------------------------------------------------
*/

Route::get(
    'laporan',
    [LaporanController::class, 'index']
)->name('laporan.index');

Route::get(
    'laporan/penduduk',
    [LaporanController::class, 'penduduk']
)->name('laporan.penduduk');

Route::get(
    'laporan/penduduk/print',
    [LaporanController::class, 'printPenduduk']
)->name('laporan.print-penduduk');

Route::get(
    'laporan/kartu-keluarga',
    [LaporanController::class, 'kartuKeluarga']
)->name('laporan.kartu-keluarga');

Route::get(
    'laporan/kartu-keluarga/print',
    [LaporanController::class, 'printKartuKeluarga']
)->name('laporan.print-kartu-keluarga');

Route::get(
    'laporan/persuratan',
    [LaporanController::class, 'persuratan']
)->name('laporan.persuratan');

Route::get(
    'laporan/persuratan/print',
    [LaporanController::class, 'printPersuratan']
)->name('laporan.print-persuratan');


/*
|--------------------------------------------------------------------------
| Export Excel Laporan
|--------------------------------------------------------------------------
*/

Route::get(
    'laporan/export-penduduk',
    [LaporanController::class, 'exportPenduduk']
)->name('laporan.export-penduduk');

Route::get(
    'laporan/export-kartu-keluarga',
    [LaporanController::class, 'exportKartuKeluarga']
)->name('laporan.export-kartu-keluarga');

Route::get(
    'laporan/export-persuratan',
    [LaporanController::class, 'exportPersuratan']
)->name('laporan.export-persuratan');
        /*
        |--------------------------------------------------------------------------
        | Website CMS
        |--------------------------------------------------------------------------
        */

        Route::prefix('website')
            ->name('website.')
            ->group(function () {

        Route::resource('berita', BeritaController::class)
            ->parameters([
             'berita' => 'berita'
        ]);
        Route::resource('pengumuman', PengumumanController::class)
            ->parameters([
            'pengumuman' => 'pengumuman'
        ]);

                Route::resource('agenda', AgendaController::class)
        ->parameters([
            'agenda' => 'agenda'
        ]);
                Route::resource('galeri', GaleriController::class);

                Route::resource('halaman', HalamanController::class);

                Route::get(
                    'pengaturan',
                    [WebsiteSettingController::class, 'index']
                )->name('pengaturan.index');

                Route::get(
                    'pengaturan/edit',
                    [WebsiteSettingController::class, 'edit']
                )->name('pengaturan.edit');

                Route::put(
                    'pengaturan',
                    [WebsiteSettingController::class, 'update']
                )->name('pengaturan.update');

            });

    });
    

       /*
|--------------------------------------------------------------------------
| Operator Pelayanan
|--------------------------------------------------------------------------
*/
Route::prefix('operator')
    ->name('operator.')
    ->middleware(['auth', 'operator'])
    ->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Operator
    |--------------------------------------------------------------------------
    */
    Route::get(
        'dashboard',
        [OperatorDashboardController::class,'index']
    )
    ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Kependudukan
    |--------------------------------------------------------------------------
    */

    Route::get(
        'penduduk/cari',
        [OperatorPendudukController::class,'search']
    )
    ->name('penduduk.search');

    Route::resource(
        'penduduk',
        OperatorPendudukController::class
    );

    Route::resource(
        'kartu-keluarga',
        OperatorKartuKeluargaController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Pelayanan Surat
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'permohonan-surat',
        OperatorPermohonanSuratController::class
    );


    Route::get(
        'riwayat-pelayanan',
        [OperatorRiwayatPelayananController::class,'index']
    )
    ->name('riwayat-pelayanan.index');
Route::get(
    'permohonan-surat/{permohonanSurat}/preview',
    [OperatorPermohonanSuratController::class, 'preview']
)
->name('permohonan-surat.preview');


Route::get(
    'permohonan-surat/{permohonanSurat}/print',
    [OperatorPermohonanSuratController::class, 'print']
)
->name('permohonan-surat.print');

 /*
|--------------------------------------------------------------------------
| Laporan Operator
|--------------------------------------------------------------------------
*/

Route::prefix('laporan')
    ->name('laporan.')
    ->group(function () {


        Route::get(
            '/',
            [OperatorLaporanController::class, 'index']
        )->name('index');


        Route::get(
            '/penduduk',
            [OperatorLaporanController::class, 'penduduk']
        )->name('penduduk');


        Route::get(
            '/penduduk/print',
            [OperatorLaporanController::class, 'printPenduduk']
        )->name('print-penduduk');


        Route::get(
            '/kartu-keluarga',
            [OperatorLaporanController::class, 'kartuKeluarga']
        )->name('kartu-keluarga');


        Route::get(
            '/kartu-keluarga/print',
            [OperatorLaporanController::class, 'printKartuKeluarga']
        )->name('print-kartu-keluarga');


        Route::get(
            '/persuratan',
            [OperatorLaporanController::class, 'persuratan']
        )->name('persuratan');


        Route::get(
            '/persuratan/print',
            [OperatorLaporanController::class, 'printPersuratan']
        )->name('print-persuratan');

/*
|--------------------------------------------------------------------------
| Export Excel
|--------------------------------------------------------------------------
*/

Route::get(
    '/penduduk/export',
    [OperatorLaporanController::class,'exportPenduduk']
)
->name('export-penduduk');


Route::get(
    '/kartu-keluarga/export',
    [OperatorLaporanController::class,'exportKartuKeluarga']
)
->name('export-kartu-keluarga');


Route::get(
    '/persuratan/export',
    [OperatorLaporanController::class,'exportPersuratan']
)
->name('export-persuratan');
    });

}); // <-- PENUTUP GROUP OPERATOR

require __DIR__.'/auth.php';