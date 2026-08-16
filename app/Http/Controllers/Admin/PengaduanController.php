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
    public function index(Request $request)
    {
        $pengaduans = Pengaduan::query()
            ->when($request->search, function($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('kode', 'like', "%{$search}%")
                      ->orWhere('nama', 'like', "%{$search}%")
                      ->orWhere('uraian', 'like', "%{$search}%");
                });
            })
            ->when($request->kategori, function($query, $kategori) {
                $query->where('kategori', $kategori);
            })
            ->when($request->status, function($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
            
        $kategoris = Pengaduan::select('kategori')->whereNotNull('kategori')->distinct()->orderBy('kategori')->pluck('kategori');

        return view('admin.pengaduan.index', compact(
            'pengaduans',
            'kategoris'
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
        $validated = $request->validate([
            'status' => 'required|in:Baru,Diproses,Selesai',
            'catatan' => 'nullable|string|max:1000'
        ], [
            'status.required' => 'Status pengaduan wajib dipilih.',
            'status.in' => 'Status pengaduan tidak valid.',
            'catatan.max' => 'Catatan petugas maksimal 1000 karakter.',
        ]);

        $pengaduan->update($validated);

        return redirect()
            ->route('admin.pengaduan.show', $pengaduan)
            ->with('success', 'Status dan catatan pengaduan berhasil diperbarui.');
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