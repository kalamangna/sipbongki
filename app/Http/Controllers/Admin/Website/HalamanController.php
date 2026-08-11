<?php

namespace App\Http\Controllers\Admin\Website;


use App\Http\Controllers\Controller;
use App\Models\Halaman;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class HalamanController extends Controller
{


    /**
     * Daftar halaman
     */
    public function index()
    {

        $halamans = Halaman::latest()
            ->paginate(10);


        return view(
            'admin.website.halaman.index',
            compact('halamans')
        );

    }





    /**
     * Form tambah halaman
     */
    public function create()
    {

        return view(
            'admin.website.halaman.create'
        );

    }






    /**
     * Simpan halaman
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
                => 'required|in:aktif,draft',


        ]);







        /*
        |--------------------------------------------------------------------------
        | Generate Slug
        |--------------------------------------------------------------------------
        */


        $validated['slug'] =
            Str::slug($validated['judul']);







        /*
        |--------------------------------------------------------------------------
        | Upload Gambar
        |--------------------------------------------------------------------------
        */


        if ($request->hasFile('gambar')) {


            $validated['gambar'] =
                $request->file('gambar')
                    ->store('halaman','public');


        }







        Halaman::create($validated);







        return redirect()

            ->route('admin.website.halaman.index')

            ->with(
                'success',
                'Halaman berhasil ditambahkan.'
            );


    }









    /**
     * Detail halaman
     */
    public function show(Halaman $halaman)
    {


        return view(
            'admin.website.halaman.show',
            compact('halaman')
        );


    }









    /**
     * Form edit
     */
    public function edit(Halaman $halaman)
    {


        return view(
            'admin.website.halaman.edit',
            compact('halaman')
        );


    }









    /**
     * Update halaman
     */
    public function update(
        Request $request,
        Halaman $halaman
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
                => 'required|in:aktif,draft',


        ]);







        /*
        |--------------------------------------------------------------------------
        | Update Slug
        |--------------------------------------------------------------------------
        */


        $validated['slug'] =
            Str::slug($validated['judul']);







        /*
        |--------------------------------------------------------------------------
        | Update Gambar
        |--------------------------------------------------------------------------
        */


        if ($request->hasFile('gambar')) {



            if ($halaman->gambar) {


                Storage::disk('public')
                    ->delete($halaman->gambar);


            }





            $validated['gambar'] =
                $request->file('gambar')
                    ->store('halaman','public');


        }







        $halaman->update($validated);







        return redirect()

            ->route('admin.website.halaman.index')

            ->with(
                'success',
                'Halaman berhasil diperbarui.'
            );


    }









    /**
     * Hapus halaman
     */
    public function destroy(Halaman $halaman)
    {


        if ($halaman->gambar) {


            Storage::disk('public')
                ->delete($halaman->gambar);


        }





        $halaman->delete();







        return redirect()

            ->route('admin.website.halaman.index')

            ->with(
                'success',
                'Halaman berhasil dihapus.'
            );


    }



}