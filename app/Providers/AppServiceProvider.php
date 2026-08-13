<?php

namespace App\Providers;

use App\Models\WebsiteSetting;
use App\Models\Pengaduan;
use App\Models\PermohonanSurat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    Paginator::useTailwind();

    /*
    |--------------------------------------------------------------------------
    | Locale Indonesia
    |--------------------------------------------------------------------------
    */

    config([
        'app.locale' => 'id',
        'app.fallback_locale' => 'id',
    ]);

    Carbon::setLocale('id');

    Date::use(Carbon::class);

    setlocale(
        LC_TIME,
        'id_ID.UTF-8',
        'id_ID',
        'Indonesian_Indonesia.1252',
        'Indonesian'
    );

/*
|--------------------------------------------------------------------------
| Website Setting
|--------------------------------------------------------------------------
*/

View::composer([
    'components.*',
    'public.*',
    'layouts.public'
], function ($view) {

    $view->with(
        'website',
        WebsiteSetting::first()
    );

});

    // Blade directive to render full gender label
    Blade::directive('gender', function ($expression) {
        return "<?php echo ({$expression}) === 'L' ? 'Laki-laki' : (({$expression}) === 'P' ? 'Perempuan' : (empty({$expression}) && ({$expression}) !== '0' ? '-' : e({$expression}))); ?>";
    });

/*
|--------------------------------------------------------------------------
| Notifikasi Admin dan Operator
|--------------------------------------------------------------------------
*/

View::composer([
    'layouts.admin',
    'components.admin.navbar',
], function ($view) {

    $jumlahPermohonanBaru = PermohonanSurat::where('status', 'Menunggu')->count();
    $jumlahPengaduanBaru = Pengaduan::where('status', 'Baru')->count();

    $view->with('jumlahPermohonanBaru', $jumlahPermohonanBaru);
    $view->with('jumlahPengaduanBaru', $jumlahPengaduanBaru);
    $view->with('jumlahNotifikasi', $jumlahPermohonanBaru + $jumlahPengaduanBaru);

});
    
}   // penutup boot()

} 