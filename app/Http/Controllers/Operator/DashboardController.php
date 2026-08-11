<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;

use App\Models\Penduduk;
use App\Models\PermohonanSurat;
use App\Models\KartuKeluarga;
use App\Models\Lingkungan;

use Carbon\Carbon;


class DashboardController extends Controller
{

    /**
     * Dashboard Operator
     */
    public function index()
    {


        /*
        |--------------------------------------------------------------------------
        | Statistik Hari Ini
        |--------------------------------------------------------------------------
        */


        $permohonanHariIni = PermohonanSurat::whereDate(
            'created_at',
            Carbon::today()
        )
        ->count();




        $sedangDiproses = PermohonanSurat::where(
            'status',
            'Diproses'
        )
        ->count();





        $selesaiHariIni = PermohonanSurat::where(
            'status',
            'Selesai'
        )
        ->whereDate(
            'updated_at',
            Carbon::today()
        )
        ->count();







        $pendudukBaru = Penduduk::whereDate(
            'created_at',
            Carbon::today()
        )
        ->count();






        /*
        |--------------------------------------------------------------------------
        | Permohonan Terbaru
        |--------------------------------------------------------------------------
        */


        $permohonanTerbaru = PermohonanSurat::with([
            'penduduk',
            'jenisSurat'
        ])
        ->latest()
        ->take(10)
        ->get();







        /*
        |--------------------------------------------------------------------------
        | Penduduk Terbaru
        |--------------------------------------------------------------------------
        */


        $pendudukTerbaru = Penduduk::with(
            'lingkungan'
        )
        ->latest()
        ->take(5)
        ->get();








        /*
        |--------------------------------------------------------------------------
        | Statistik Penduduk
        |--------------------------------------------------------------------------
        */


        $totalPenduduk = Penduduk::count();


        $totalKK = KartuKeluarga::count();



        $totalLingkungan = Lingkungan::count();







        return view(
            'operator.dashboard',
            compact(

                'permohonanHariIni',

                'sedangDiproses',

                'selesaiHariIni',

                'pendudukBaru',

                'permohonanTerbaru',

                'pendudukTerbaru',

                'totalPenduduk',

                'totalKK',

                'totalLingkungan'

            )
        );


    }


}