<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanSurat;
use Illuminate\Http\Request;

class RiwayatPelayananController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $riwayats = PermohonanSurat::with([
                'penduduk',
                'jenisSurat',
                'penandatangan'
            ])

            ->whereIn('status', [
                'Selesai',
                'Ditolak'
            ])

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'nomor_permohonan',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhereHas('penduduk', function ($p) use ($search) {

                        $p->where(
                            'nama_lengkap',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'nik',
                            'like',
                            "%{$search}%"
                        );

                    })

                    ->orWhereHas('jenisSurat', function ($j) use ($search) {

                        $j->where(
                            'nama',
                            'like',
                            "%{$search}%"
                        );

                    });

                });

            })

            ->latest('tanggal_selesai')

            ->paginate(10)

            ->withQueryString();

        return view(
            'admin.pelayanan.riwayat.index',
            compact(
                'riwayats',
                'search'
            )
        );
    }
}