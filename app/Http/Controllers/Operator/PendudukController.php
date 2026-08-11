<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;

use App\Models\Penduduk;
use App\Models\Lingkungan;
use App\Models\KartuKeluarga;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PendudukController extends Controller
{


    /**
     * Daftar Penduduk
     */
    public function index()
    {

        $penduduk = Penduduk::with([
            'lingkungan',
            'kartuKeluarga'
        ])
        ->latest()
        ->paginate(15);


        return view(
            'operator.penduduk.index',
            compact('penduduk')
        );

    }


    /**
     * Form Tambah Penduduk
     */
    public function create()
    {


        $lingkungan = Lingkungan::orderBy(
            'nama'
        )
        ->get();



        $kartuKeluarga = KartuKeluarga::orderBy(
            'no_kk'
        )
        ->get();


        return view(
            'operator.penduduk.create',
            compact(
                'lingkungan',
                'kartuKeluarga'
            )
        );


    }



    /**
     * Simpan Penduduk Baru
     */
    public function store(Request $request)
    {


        $validated = $request->validate([


            'nik' => [

                'required',

                'numeric',

                'digits:16',

                'unique:penduduks,nik'

            ],


            'nama_lengkap' => [

                'required',

                'string',

                'max:255'

            ],


            'jenis_kelamin' => [

                'required'

            ],


            'tempat_lahir' => [

                'nullable',

                'string'

            ],


            'tanggal_lahir' => [

                'nullable',

                'date'

            ],


            'agama' => [

                'nullable'

            ],


            'pendidikan' => [

                'nullable'

            ],


            'pekerjaan' => [

                'nullable'

            ],


            'alamat' => [

                'required',

                'string'

            ],


            'rt' => [

                'nullable'

            ],


            'rw' => [

                'nullable'

            ],

            'lingkungan_id' => [

                'required',

                'exists:lingkungan,id'

            ],

            'kartu_keluarga_id' => [

                'nullable',

                'exists:kartu_keluargas,id'

            ],

            'foto' => [

                'nullable',

                'image',

                'max:2048'

            ]



        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */


        if($request->hasFile('foto')){


            $validated['foto'] =

                $request->file('foto')
                ->store(
                    'penduduk',
                    'public'
                );


        }


        /*
        |--------------------------------------------------------------------------
        | Default RT RW
        |--------------------------------------------------------------------------
        */


        $validated['rt'] =
            $validated['rt'] ?? '00';


        $validated['rw'] =
            $validated['rw'] ?? '00';


        /*
        |--------------------------------------------------------------------------
        | Status Aktif
        |--------------------------------------------------------------------------
        */


        $validated['aktif'] = true;

        Penduduk::create($validated);

        return redirect()

            ->route(
                'operator.penduduk.index'
            )

            ->with(
                'success',
                'Data penduduk berhasil ditambahkan.'
            );

    }


    /**
     * Detail Penduduk
     */
    public function show(
        Penduduk $penduduk
    )
    {

        $penduduk->load([
            'lingkungan',
            'kartuKeluarga'
        ]);

        return view(
            'operator.penduduk.show',
            compact('penduduk')
        );


    }

    /**
     * Edit Penduduk
     */
    public function edit(
        Penduduk $penduduk
    )
    {


        $lingkungan = Lingkungan::orderBy(
            'nama'
        )
        ->get();

        $kartuKeluarga = KartuKeluarga::orderBy(
            'no_kk'
        )
        ->get();


        return view(
            'operator.penduduk.edit',
            compact(
                'penduduk',
                'lingkungan',
                'kartuKeluarga'
            )
        );


    }

    /**
     * Update Penduduk
     */
    public function update(
        Request $request,
        Penduduk $penduduk
    )
    {

        $validated = $request->validate([


            'nama_lengkap'=>'required',

            'jenis_kelamin'=>'required',

            'alamat'=>'required',

            'lingkungan_id'=>'required'

        ]);

        $penduduk->update(
            $validated
        );

        return redirect()

            ->route(
                'operator.penduduk.index'
            )

            ->with(
                'success',
                'Data penduduk berhasil diperbarui.'
            );


    }

public function search(Request $request)
{

    $keyword = $request->keyword;


    $penduduk = Penduduk::where(
        'nik',
        'like',
        "%$keyword%"
    )
    ->orWhere(
        'nama_lengkap',
        'like',
        "%$keyword%"
    )
    ->limit(10)
    ->get();

    return response()->json(
        $penduduk
    );

}


    /**
     * Hapus tidak diberikan untuk operator
     */

}