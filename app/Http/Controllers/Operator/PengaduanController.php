<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Daftar pengaduan untuk operator.
     */
    public function index()
    {
        $pengaduans = Pengaduan::latest()
            ->paginate(15);

        return view('operator.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Detail pengaduan.
     */
    public function show(Pengaduan $pengaduan)
    {
        return view('operator.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Update status pengaduan.
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
            ->route('operator.pengaduan.index')
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    /**
     * Hapus pengaduan.
     */
    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();

        return redirect()
            ->route('operator.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
