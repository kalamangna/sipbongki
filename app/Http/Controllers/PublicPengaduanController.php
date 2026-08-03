<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Str;

class PublicPengaduanController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([

            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'kategori' => 'required',
            'lokasi' => 'required',
            'uraian' => 'required',

            'foto' => 'nullable|image|max:2048',

        ]);


        $foto = null;


        if ($request->hasFile('foto')) {

            $foto = $request->file('foto')
                ->store('pengaduan', 'public');

        }


        Pengaduan::create([

            'kode' => 'ADU-' . date('Ymd') . '-' . Str::upper(Str::random(5)),

            'nama' => $request->nama,

            'telepon' => $request->telepon,

            'alamat' => $request->alamat,

            'kategori' => $request->kategori,

            'lokasi' => $request->lokasi,

            'uraian' => $request->uraian,

            'foto' => $foto,

            'status' => 'Baru',

        ]);


        return redirect()
            ->back()
            ->with('success', 'Pengaduan berhasil dikirim.');
    }
}