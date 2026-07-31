<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;

use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use App\Models\Lingkungan;

use Illuminate\Http\Request;


class KartuKeluargaController extends Controller
{

public function index()
{

    $kartuKeluarga = KartuKeluarga::with([
    'kepalaKeluarga',
    'lingkungan'
])
->latest()
->paginate(15);


return view(
    'operator.kartu-keluarga.index',
    compact('kartuKeluarga')
);

}



    public function create()
    {

        $penduduk = Penduduk::orderBy(
            'nama_lengkap'
        )
        ->get();


        $lingkungan = Lingkungan::orderBy(
            'nama'
        )
        ->get();


        return view(
            'operator.kartu-keluarga.create',
            compact(
                'penduduk',
                'lingkungan'
            )
        );

    }





    public function store(Request $request)
    {

        $validated = $request->validate([


            'no_kk'=>[
                'required',
                'numeric',
                'digits:16',
                'unique:kartu_keluargas,no_kk'
            ],


            'kepala_keluarga_id'=>[
                'required',
                'exists:penduduks,id'
            ],


            'alamat'=>[
                'required'
            ],


            'lingkungan_id'=>[
                'required',
                'exists:lingkungan,id'
            ],


            'rt'=>[
                'nullable'
            ],


            'rw'=>[
                'nullable'
            ]

        ]);



        $validated['rt'] =
            $validated['rt'] ?? '00';


        $validated['rw'] =
            $validated['rw'] ?? '00';



        $validated['aktif'] = true;



        KartuKeluarga::create(
            $validated
        );



        return redirect()

            ->route(
                'operator.kartu-keluarga.index'
            )

            ->with(
                'success',
                'Data kartu keluarga berhasil ditambahkan.'
            );

    }





    public function show(
        KartuKeluarga $kartuKeluarga
    )
    {

        $kartuKeluarga->load([
            'kepalaKeluarga',
            'anggota',
            'lingkungan'
        ]);


        return view(
            'operator.kartu-keluarga.show',
            compact('kartuKeluarga')
        );

    }





    public function edit(
        KartuKeluarga $kartuKeluarga
    )
    {

        $penduduk = Penduduk::orderBy(
            'nama_lengkap'
        )
        ->get();


        $lingkungan = Lingkungan::orderBy(
            'nama'
        )
        ->get();


        return view(
            'operator.kartu-keluarga.edit',
            compact(
                'kartuKeluarga',
                'penduduk',
                'lingkungan'
            )
        );

    }





    public function update(
        Request $request,
        KartuKeluarga $kartuKeluarga
    )
    {

        $validated = $request->validate([

            'kepala_keluarga_id'=>'required',
            'alamat'=>'required',
            'lingkungan_id'=>'required'

        ]);



        $kartuKeluarga->update(
            $validated
        );



        return redirect()

            ->route(
                'operator.kartu-keluarga.index'
            )

            ->with(
                'success',
                'Data kartu keluarga diperbarui.'
            );

    }


}