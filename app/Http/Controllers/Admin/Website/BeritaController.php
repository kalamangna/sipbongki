<?php

namespace App\Http\Controllers\Admin\Website;


use App\Http\Controllers\Controller;
use App\Models\Berita;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class BeritaController extends Controller
{


    /**
     * Menampilkan daftar berita
     */
    public function index()
    {

        $beritas = Berita::latest()
            ->paginate(10);


        return view(
            'admin.website.berita.index',
            compact('beritas')
        );

    }





    /**
     * Form tambah berita
     */
    public function create()
    {

        return view(
            'admin.website.berita.create'
        );

    }





    /**
     * Simpan berita baru
     */
    public function store(Request $request)
    {


        $validated = $request->validate([


            'judul'
                => 'required|string|max:255',


            'isi'
                => 'required|string',


            'gambar'
                => 'nullable|image|max:2048',


            'status'
                => 'required|in:draft,publish',


            'tanggal_publish'
                => 'nullable|date',


        ]);





        /*
        |--------------------------------------------------------------------------
        | Upload Gambar
        |--------------------------------------------------------------------------
        */


        if ($request->hasFile('gambar')) {


            $validated['gambar'] =
                $request->file('gambar')
                    ->store('berita','public');


        }






        /*
        |--------------------------------------------------------------------------
        | Generate Slug
        |--------------------------------------------------------------------------
        */


        $validated['slug'] =
            Str::slug($validated['judul']);







        Berita::create($validated);





        return redirect()

            ->route('admin.website.berita.index')

            ->with(
                'success',
                'Berita berhasil ditambahkan.'
            );


    }







    /**
     * Detail berita
     */
    public function show(Berita $berita)
    {

        return view(
            'admin.website.berita.show',
            compact('berita')
        );

    }







    /**
     * Form edit
     */
    public function edit(Berita $berita)
    {


        return view(
            'admin.website.berita.edit',
            compact('berita')
        );


    }








    /**
     * Update berita
     */
    public function update(
        Request $request,
        Berita $berita
    )
    {


        $validated = $request->validate([


            'judul'
                => 'required|string|max:255',


            'isi'
                => 'required|string',


            'gambar'
                => 'nullable|image|max:2048',


            'status'
                => 'required|in:draft,publish',


            'tanggal_publish'
                => 'nullable|date',


        ]);






        if ($request->hasFile('gambar')) {



            if ($berita->gambar) {


                Storage::disk('public')
                    ->delete($berita->gambar);


            }



            $validated['gambar'] =
                $request->file('gambar')
                    ->store('berita','public');


        }







        $validated['slug'] =
            Str::slug($validated['judul']);







        $berita->update($validated);






        return redirect()

            ->route('admin.website.berita.index')

            ->with(
                'success',
                'Berita berhasil diperbarui.'
            );


    }









    /**
     * Hapus berita
     */
    public function destroy(Berita $berita)
    {


        if ($berita->gambar) {


            Storage::disk('public')
                ->delete($berita->gambar);


        }





        $berita->delete();






        return redirect()

            ->route('admin.website.berita.index')

            ->with(
                'success',
                'Berita berhasil dihapus.'
            );


    }



}