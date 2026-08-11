<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\PermohonanSurat;


class RiwayatPelayananController extends Controller
{

    public function index()
    {

        $riwayat = PermohonanSurat::with([
            'penduduk',
            'jenisSurat'
        ])
        ->latest()
        ->paginate(15);


        return view(
            'operator.riwayat-pelayanan.index',
            compact('riwayat')
        );

    }

}