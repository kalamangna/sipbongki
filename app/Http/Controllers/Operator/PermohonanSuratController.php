<?php

namespace App\Http\Controllers\Operator;


use App\Http\Controllers\Controller;

use App\Models\PermohonanSurat;
use App\Models\Penduduk;
use App\Models\JenisSurat;
use App\Models\Perangkat;

use Illuminate\Http\Request;



class PermohonanSuratController extends Controller
{



    /**
     * Daftar Permohonan Surat
     */
    public function index()
    {


        $permohonan = PermohonanSurat::with([
            'penduduk',
            'jenisSurat'
        ])
        ->latest()
        ->paginate(15);



        return view(
            'operator.permohonan-surat.index',
            compact('permohonan')
        );


    }








    /**
     * Form Permohonan
     */
    public function create()
    {



        $penduduk = Penduduk::orderBy(
            'nama_lengkap'
        )
        ->get();



        $jenisSurat = JenisSurat::orderBy(
            'nama'
        )
        ->get();



        return view(
            'operator.permohonan-surat.create',
            compact(
                'penduduk',
                'jenisSurat'
            )
        );


    }










    /**
     * Simpan Permohonan
     */
    public function store(Request $request)
    {


        $validated = $request->validate([


            'penduduk_id'=>[
                'required',
                'exists:penduduks,id'
            ],


            'jenis_surat_id'=>[
                'required',
                'exists:jenis_surats,id'
            ],


            'keperluan'=>[
                'nullable',
                'string'
            ]



        ]);






        $validated['status'] = 'Menunggu';




        PermohonanSurat::create(
            $validated
        );





        return redirect()

            ->route(
                'operator.permohonan-surat.index'
            )

            ->with(
                'success',
                'Permohonan surat berhasil dibuat.'
            );


    }










    /**
     * Detail
     */
    public function show(
        PermohonanSurat $permohonanSurat
    )
    {


        $permohonanSurat->load([
            'penduduk',
            'jenisSurat'
        ]);



        return view(
            'operator.permohonan-surat.show',
            compact('permohonanSurat')
        );


    }


public function preview(PermohonanSurat $permohonanSurat)
{
    $permohonanSurat->load([
        'penduduk.lingkungan',
        'jenisSurat',
    ]);

    $template = $permohonanSurat->jenisSurat->template;

    if (!view()->exists($template)) {
        abort(404, "Template surat '{$template}' tidak ditemukan.");
    }

    $penandatangan = Perangkat::with('jabatan')
        ->where('aktif', true)
        ->where('dapat_menandatangani', true)
        ->orderBy('level')
        ->first();

    if (!$penandatangan) {
        abort(500, 'Belum ada perangkat yang dapat menandatangani surat.');
    }

    return view($template, [
        'permohonan'     => $permohonanSurat,
        'penandatangan'  => $penandatangan,
    ]);
}



public function print(
    PermohonanSurat $permohonanSurat
)
{
    $permohonanSurat->load([
        'penduduk',
        'jenisSurat'
    ]);

    return view(
        'operator.permohonan-surat.print',
        compact('permohonanSurat')
    );
}

}