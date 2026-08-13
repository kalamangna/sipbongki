<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;
use App\Models\Lingkungan;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\KartuKeluarga;

class PendudukController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Daftar Penduduk
    |--------------------------------------------------------------------------
    */
public function index(Request $request)
{
    $search = trim($request->search);
    $lingkungan = $request->lingkungan;
    $aktif = $request->aktif;
    $sort = $request->sort ?? 'nama_lengkap';
    $direction = $request->direction ?? 'asc';

    $penduduks = Penduduk::with(['lingkungan', 'kartuKeluarga'])
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%");
            });
        })
        ->when($lingkungan, function ($query) use ($lingkungan) {
            $query->where('lingkungan_id', $lingkungan);
        })
        ->when($request->has('aktif') && $aktif !== '', function ($query) use ($aktif) {
            $query->where('aktif', $aktif);
        })
        ->orderBy($sort, $direction)
        ->paginate(10)
        ->withQueryString();

    $lingkungans = Lingkungan::orderBy('nama')->get();

    return view(
        'admin.kependudukan.penduduk.index',
        compact(
            'penduduks',
            'search',
            'lingkungans',
            'lingkungan',
            'aktif',
            'sort',
            'direction'
        )
    );
}
    





    /*
    |--------------------------------------------------------------------------
    | Form Tambah Penduduk
    |--------------------------------------------------------------------------
    */

 public function create()
{
    $penduduk = new Penduduk();

    $lingkungans = Lingkungan::orderBy('nama')->get();

    $kartuKeluargas = KartuKeluarga::with('kepalaKeluarga')
        ->orderBy('no_kk')
        ->get();

    return view(
        'admin.kependudukan.penduduk.create',
        compact(
            'penduduk',
            'lingkungans',
            'kartuKeluargas'
        )
    );
}




    /*
    |--------------------------------------------------------------------------
    | Simpan Penduduk
    |--------------------------------------------------------------------------
    */

    public function store(
        StorePendudukRequest $request
    ) {


        $data = $request->validated();



        /*
        |--------------------------------------------------------------------------
        | Validasi RT RW
        |--------------------------------------------------------------------------
        */

        if (

            empty($data['rt']) ||

            empty($data['rw']) ||

            $data['rt'] === '00' ||

            $data['rw'] === '00'

        ) {

            $data['status_validasi_alamat']
                = 'Perlu Verifikasi';


        } else {


            $data['status_validasi_alamat']
                = 'Valid';

        }





        /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {


            $data['foto'] =
                $request->file('foto')
                ->store(
                    'penduduk',
                    'public'
                );

        }



        Penduduk::create($data);



        return redirect()

            ->route(
                'admin.penduduk.index'
            )

            ->with(
                'success',
                'Data penduduk berhasil ditambahkan.'
            );

    }





    /*
    |--------------------------------------------------------------------------
    | Detail Penduduk
    |--------------------------------------------------------------------------
    */

    public function show(
        Penduduk $penduduk
    ) {


        $penduduk->load([

            'lingkungan',

            'kartuKeluarga.penduduks'

        ]);



        return view(
            'admin.kependudukan.penduduk.show',
            compact('penduduk')
        );

    }





    /*
    |--------------------------------------------------------------------------
    | Form Edit
    |--------------------------------------------------------------------------
    */

    public function edit(Penduduk $penduduk)
{
    $lingkungans = Lingkungan::orderBy('nama')->get();

    $kartuKeluargas = KartuKeluarga::with('kepalaKeluarga')
        ->orderBy('no_kk')
        ->get();

    return view(
        'admin.kependudukan.penduduk.edit',
        compact(
            'penduduk',
            'lingkungans',
            'kartuKeluargas'
        )
    );
}




    /*
    |--------------------------------------------------------------------------
    | Update Penduduk
    |--------------------------------------------------------------------------
    */

    public function update(

        UpdatePendudukRequest $request,

        Penduduk $penduduk

    ) {


        $data = $request->validated();




        if (

            empty($data['rt']) ||

            empty($data['rw']) ||

            $data['rt'] === '00' ||

            $data['rw'] === '00'

        ) {


            $data['status_validasi_alamat']
                = 'Perlu Verifikasi';


        } else {


            $data['status_validasi_alamat']
                = 'Valid';

        }




        /*
        |--------------------------------------------------------------------------
        | Update Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {


            if (

                $penduduk->foto &&

                Storage::disk('public')
                ->exists($penduduk->foto)

            ) {


                Storage::disk('public')
                    ->delete(
                        $penduduk->foto
                    );

            }



            $data['foto'] =

                $request
                ->file('foto')
                ->store(
                    'penduduk',
                    'public'
                );

        }




        $penduduk->update($data);



        return redirect()

            ->route(
                'admin.penduduk.index'
            )

            ->with(
                'success',
                'Data penduduk berhasil diperbarui.'
            );

    }





    /*
    |--------------------------------------------------------------------------
    | Hapus Penduduk
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Penduduk $penduduk
    ) {


        if (

            $penduduk->foto &&

            Storage::disk('public')
            ->exists($penduduk->foto)

        ) {


            Storage::disk('public')
                ->delete(
                    $penduduk->foto
                );

        }



        $penduduk->delete();



        return redirect()

            ->route(
                'admin.penduduk.index'
            )

            ->with(
                'success',
                'Data penduduk berhasil dihapus.'
            );

    }

}