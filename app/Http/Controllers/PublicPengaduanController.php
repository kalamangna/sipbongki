<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Str;

class PublicPengaduanController extends Controller
{
    public function statusPage()
    {
        return view('public.pengaduan-status');
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('public.pengaduan-success', compact('pengaduan'));
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
        ]);

        $pengaduan = Pengaduan::where('kode', $request->kode)
            ->first();

        if (!$pengaduan) {
            return back()
                ->with('error', 'Kode pengaduan tidak ditemukan. Silakan periksa kembali kode yang Anda masukkan.')
                ->withInput();
        }

        return view('public.pengaduan-status-detail', compact('pengaduan'));
    }

    public function store(Request $request)
    {
        if ($request->filled('form_hp_check')) {
            return back()->with('error', 'Permintaan terindikasi spam.');
        }

        $request->validate([

            'nama' => 'required',
            'nik_pelapor' => 'required|string|max:30',
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


        $pengaduan = Pengaduan::create([

            'kode' => 'ADU-' . date('Ymd') . '-' . Str::upper(Str::random(5)),

            'nama' => $request->nama,

            'nik_pelapor' => $request->nik_pelapor,

            'telepon' => $request->telepon,

            'alamat' => $request->alamat,

            'kategori' => $request->kategori,

            'lokasi' => $request->lokasi,

            'uraian' => $request->uraian,

            'foto' => $foto,

            'status' => 'Baru',

        ]);


        return redirect()
            ->route('pengaduan.show', $pengaduan)
            ->with('success', 'Pengaduan berhasil dikirim. Kode pengaduan: ' . $pengaduan->kode);
    }
}