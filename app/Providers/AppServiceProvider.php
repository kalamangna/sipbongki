<?php

namespace App\Providers;

use App\Models\WebsiteSetting;
use App\Models\Pengaduan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
    Paginator::useBootstrapFive();

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

        View::composer('components.*', function ($view) {

            $view->with(
                'website',
                WebsiteSetting::first()
            );

        });

        View::composer('public.*', function ($view) {

            $view->with(
                'website',
                WebsiteSetting::first()
            );

        });

        /*
|--------------------------------------------------------------------------
| Notifikasi Pengaduan Admin
|--------------------------------------------------------------------------
*/

View::composer('layouts.admin', function ($view) {

    $view->with(
        'jumlahPengaduanBaru',
        Pengaduan::where('status', 'Baru')->count()
    );

});
    
}   // penutup boot()

} 