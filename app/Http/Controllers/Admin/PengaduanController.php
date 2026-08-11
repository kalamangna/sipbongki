<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Daftar pengaduan
     */
    public function index()
    {
        $pengaduans = Pengaduan::latest()
            ->paginate(10);

        return view('admin.pengaduan.index', compact(
            'pengaduans'
        ));
    }

    /**
     * Detail pengaduan
     */
    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact(
            'pengaduan'
        ));
    }

    /**
     * Form tambah (belum digunakan)
     */
    public function create()
    {
        return redirect()
            ->route('admin.pengaduan.index');
    }

    /**
     * Simpan (nanti digunakan dari website)
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Form edit
     */
    public function edit(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.edit', compact(
            'pengaduan'
        ));
    }

    /**
     * Update data
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:Baru,Diproses,Selesai',
            'catatan' => 'nullable|string'
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    /**
     * Hapus
     */
    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}