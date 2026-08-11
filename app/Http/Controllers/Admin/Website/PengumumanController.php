<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Menampilkan daftar pengumuman
     */
    public function index()
    {
        $pengumumen = Pengumuman::latest()
            ->paginate(10);

        return view(
            'admin.website.pengumuman.index',
            compact('pengumumen')
        );
    }

    /**
     * Form tambah pengumuman
     */
    public function create()
    {
        return view(
            'admin.website.pengumuman.create'
        );
    }

    /**
     * Simpan pengumuman
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'judul' => 'required|string|max:255',

            'isi' => 'required|string',

            'gambar' => 'nullable|image|max:2048',

            'status' => 'required|in:draft,publish',

            'tanggal_publish' => 'nullable|date',

        ]);

        if ($request->hasFile('gambar')) {

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('pengumuman', 'public');

        }

        $validated['slug'] = Str::slug($validated['judul']);

        Pengumuman::create($validated);

        return redirect()
            ->route('admin.website.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil ditambahkan.'
            );
    }

    /**
     * Detail pengumuman
     */
    public function show(Pengumuman $pengumuman)
    {
        return view(
            'admin.website.pengumuman.show',
            compact('pengumuman')
        );
    }

    /**
     * Form edit
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view(
            'admin.website.pengumuman.edit',
            compact('pengumuman')
        );
    }

    /**
     * Update pengumuman
     */
    public function update(
        Request $request,
        Pengumuman $pengumuman
    ) {

        $validated = $request->validate([

            'judul' => 'required|string|max:255',

            'isi' => 'required|string',

            'gambar' => 'nullable|image|max:2048',

            'status' => 'required|in:draft,publish',

            'tanggal_publish' => 'nullable|date',

        ]);

        if ($request->hasFile('gambar')) {

            if ($pengumuman->gambar) {

                Storage::disk('public')
                    ->delete($pengumuman->gambar);

            }

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('pengumuman', 'public');

        }

        $validated['slug'] = Str::slug($validated['judul']);

        $pengumuman->update($validated);

        return redirect()
            ->route('admin.website.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil diperbarui.'
            );
    }

    /**
     * Hapus pengumuman
     */
    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->gambar) {

            Storage::disk('public')
                ->delete($pengumuman->gambar);

        }

        $pengumuman->delete();

        return redirect()
            ->route('admin.website.pengumuman.index')
            ->with(
                'success',
                'Pengumuman berhasil dihapus.'
            );
    }
}