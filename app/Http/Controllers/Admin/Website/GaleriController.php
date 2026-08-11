<?php

namespace App\Http\Controllers\Admin\Website;


use App\Http\Controllers\Controller;

use App\Models\Galeri;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;



class GaleriController extends Controller
{


    /**
     * Menampilkan daftar galeri
     */
    public function index()
    {

        $galeris = Galeri::latest()
            ->paginate(10);


        return view(
            'admin.website.galeri.index',
            compact('galeris')
        );

    }





    /**
     * Form tambah galeri
     */
    public function create()
    {

        return view(
            'admin.website.galeri.create'
        );

    }





    /**
     * Simpan galeri
     */
    public function store(Request $request)
    {


        $validated = $request->validate([


            'judul'
                => 'required|string|max:255',


            'deskripsi'
                => 'nullable|string',


            'gambar'
                => 'required|image|max:2048',


            'status'
                => 'required|in:aktif,nonaktif',


        ]);





        /*
        |--------------------------------------------------------------------------
        | Upload gambar
        |--------------------------------------------------------------------------
        */


        if($request->hasFile('gambar')){


            $validated['gambar'] =

                $request->file('gambar')
                    ->store('galeri','public');


        }







        Galeri::create($validated);






        return redirect()

            ->route('admin.website.galeri.index')

            ->with(
                'success',
                'Galeri berhasil ditambahkan.'
            );


    }







    /**
     * Detail galeri
     */
    public function show(Galeri $galeri)
    {

        return view(
            'admin.website.galeri.show',
            compact('galeri')
        );

    }








    /**
     * Edit galeri
     */
    public function edit(Galeri $galeri)
    {

        return view(
            'admin.website.galeri.edit',
            compact('galeri')
        );

    }








    /**
     * Update galeri
     */
    public function update(
        Request $request,
        Galeri $galeri
    )
    {


        $validated = $request->validate([


            'judul'
                => 'required|string|max:255',


            'deskripsi'
                => 'nullable|string',


            'gambar'
                => 'nullable|image|max:2048',


            'status'
                => 'required|in:aktif,nonaktif',


        ]);







        if($request->hasFile('gambar')){


            if($galeri->gambar){


                Storage::disk('public')
                    ->delete($galeri->gambar);


            }





            $validated['gambar'] =

                $request->file('gambar')
                    ->store('galeri','public');


        }







        $galeri->update($validated);







        return redirect()

            ->route('admin.website.galeri.index')

            ->with(
                'success',
                'Galeri berhasil diperbarui.'
            );


    }









    /**
     * Hapus galeri
     */
    public function destroy(Galeri $galeri)
    {


        if($galeri->gambar){


            Storage::disk('public')
                ->delete($galeri->gambar);


        }





        $galeri->delete();






        return redirect()

            ->route('admin.website.galeri.index')

            ->with(
                'success',
                'Galeri berhasil dihapus.'
            );


    }


}