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
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Website\PengumumanController;
use App\Http\Controllers\Admin\PengaduanController;

use App\Http\Controllers\PublicPengaduanController;

use App\Http\Controllers\Operator\DashboardController as OperatorDashboardController;
use App\Http\Controllers\Operator\PendudukController as OperatorPendudukController;
use App\Http\Controllers\Operator\KartuKeluargaController as OperatorKartuKeluargaController;
use App\Http\Controllers\Operator\PermohonanSuratController as OperatorPermohonanSuratController;
use App\Http\Controllers\Operator\PengaduanController as OperatorPengaduanController;
use App\Http\Controllers\Operator\RiwayatPelayananController as OperatorRiwayatPelayananController;
use App\Http\Controllers\Operator\LaporanController as OperatorLaporanController;

use App\Http\Controllers\Admin\Website\BeritaController;
use App\Http\Controllers\Admin\Website\AgendaController;
use App\Http\Controllers\Admin\Website\GaleriController;
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


/*
|--------------------------------------------------------------------------
| Pengaduan
|--------------------------------------------------------------------------
*/

Route::get('/pengaduan', [HomeController::class, 'pengaduan'])
    ->name('pengaduan');

Route::get('/pengaduan/berhasil/{pengaduan}', [PublicPengaduanController::class, 'show'])
    ->name('pengaduan.show');

Route::get('/pengaduan/status', [PublicPengaduanController::class, 'statusPage'])
    ->name('pengaduan.status');

Route::post('/pengaduan/status', [PublicPengaduanController::class, 'checkStatus'])
    ->name('pengaduan.status.check');

Route::post('/pengaduan',
    [PublicPengaduanController::class, 'store']
)->name('pengaduan.store');

/*
|--------------------------------------------------------------------------
| Permohonan Surat (Publik) - akses tanpa login
|--------------------------------------------------------------------------
*/
Route::get('/permohonan', [\App\Http\Controllers\PublicPermohonanController::class, 'create'])
    ->name('permohonan.create');

Route::post('/permohonan/lookup', [\App\Http\Controllers\PublicPermohonanController::class, 'lookup'])
    ->name('permohonan.lookup');

Route::post('/permohonan', [\App\Http\Controllers\PublicPermohonanController::class, 'store'])
    ->name('permohonan.store');

Route::get('/permohonan/berhasil/{permohonanSurat}', [\App\Http\Controllers\PublicPermohonanController::class, 'show'])
    ->name('permohonan.show');

// Public: Cek status permohonan
Route::get('/permohonan/status/check', [\App\Http\Controllers\PublicPermohonanController::class, 'checkStatus'])
    ->name('permohonan.status.check');

/*
|--------------------------------------------------------------------------
| Dashboard Breeze
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
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

        // Admin: Manajemen User
        Route::get('pengaturan/user', [UserController::class, 'index'])
            ->name('user.index');

        Route::get('pengaturan/user/create', [UserController::class, 'create'])
            ->name('user.create');

        Route::post('pengaturan/user', [UserController::class, 'store'])
            ->name('user.store');

        Route::get('pengaturan/user/{user}/edit', [UserController::class, 'edit'])
            ->name('user.edit');

        Route::put('pengaturan/user/{user}', [UserController::class, 'update'])
            ->name('user.update');

        Route::delete('pengaturan/user/{user}', [UserController::class, 'destroy'])
            ->name('user.destroy');

        Route::get('pengaturan/user/roles', [UserController::class, 'roles'])
            ->name('user.roles');


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

        Route::get(
            'kartu-keluarga/penduduk/{penduduk}',
            [KartuKeluargaController::class, 'getPenduduk']
        )->name('kartu-keluarga.penduduk');

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

        Route::patch(
            'permohonan-surat/{permohonanSurat}/note',
            [PermohonanSuratController::class, 'updateNote']
        )->name('permohonan-surat.update-note');


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
    'laporan/statistik',
    [LaporanController::class, 'statistik']
)->name('laporan.statistik');

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
    'laporan/kartu-keluarga/{kartuKeluarga}',
    [LaporanController::class, 'showKartuKeluarga']
)->name('laporan.kartu-keluarga.show');

Route::get(
    'laporan/persuratan',
    [LaporanController::class, 'persuratan']
)->name('laporan.persuratan');

Route::get(
    'laporan/persuratan/print',
    [LaporanController::class, 'printPersuratan']
)->name('laporan.print-persuratan');

Route::get(
    'laporan/persuratan/{permohonanSurat}',
    [LaporanController::class, 'showPersuratan']
)->name('laporan.persuratan.show');


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
    

       

// Portal Warga removed: warga login/registration/dashboard no longer supported.


require __DIR__.'/auth.php';