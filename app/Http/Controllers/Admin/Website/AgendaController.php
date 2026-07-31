<?php

namespace App\Http\Controllers\Admin\Website;


use App\Http\Controllers\Controller;
use App\Models\Agenda;

use Illuminate\Http\Request;



class AgendaController extends Controller
{


    /**
     * Daftar agenda
     */
    public function index()
    {

        $agendas = Agenda::latest('tanggal')
            ->paginate(10);


        return view(
            'admin.website.agenda.index',
            compact('agendas')
        );

    }






    /**
     * Form tambah agenda
     */
    public function create()
    {

        return view(
            'admin.website.agenda.create'
        );

    }







    /**
     * Simpan agenda
     */
    public function store(Request $request)
    {


        $validated = $request->validate([


            'judul'
                => 'required|string|max:255',


            'deskripsi'
                => 'nullable|string',


            'tanggal'
                => 'required|date',


            'waktu'
                => 'nullable',


            'lokasi'
                => 'nullable|string|max:255',


            'status'
                => 'required|in:aktif,nonaktif',


        ]);



        Agenda::create($validated);



        return redirect()

            ->route('admin.website.agenda.index')

            ->with(
                'success',
                'Agenda berhasil ditambahkan.'
            );


    }








    /**
     * Detail agenda
     */
    public function show(Agenda $agenda)
    {

        return view(
            'admin.website.agenda.show',
            compact('agenda')
        );

    }








    /**
     * Edit agenda
     */
    public function edit(Agenda $agenda)
    {

        return view(
            'admin.website.agenda.edit',
            compact('agenda')
        );

    }








    /**
     * Update agenda
     */
    public function update(
        Request $request,
        Agenda $agenda
    )
    {


        $validated = $request->validate([


            'judul'
                => 'required|string|max:255',


            'deskripsi'
                => 'nullable|string',


            'tanggal'
                => 'required|date',


            'waktu'
                => 'nullable',


            'lokasi'
                => 'nullable|string|max:255',


            'status'
                => 'required|in:aktif,nonaktif',


        ]);



        $agenda->update($validated);



        return redirect()

            ->route('admin.website.agenda.index')

            ->with(
                'success',
                'Agenda berhasil diperbarui.'
            );


    }









    /**
     * Hapus agenda
     */
    public function destroy(Agenda $agenda)
    {


        $agenda->delete();



        return redirect()

            ->route('admin.website.agenda.index')

            ->with(
                'success',
                'Agenda berhasil dihapus.'
            );


    }


}