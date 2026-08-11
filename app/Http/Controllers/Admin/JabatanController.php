<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJabatanRequest;
use App\Http\Requests\UpdateJabatanRequest;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $jabatans = Jabatan::with('parent')
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->orderBy('urutan')
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.referensi.jabatan.index',
            compact('jabatans', 'search')
        );
    }

    public function create()
    {
        $parentJabatans = Jabatan::aktif()
            ->orderBy('urutan')
            ->orderBy('nama')
            ->get();

        return view(
            'admin.referensi.jabatan.create',
            compact('parentJabatans')
        );
    }

    public function store(StoreJabatanRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($request->nama);

        $data['is_penandatangan'] = $request->boolean('is_penandatangan');
        $data['is_struktur']      = $request->boolean('is_struktur');
        $data['aktif']            = $request->boolean('aktif');

        Jabatan::create($data);

        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil ditambahkan.');
    }

    public function edit(Jabatan $jabatan)
    {
        $parentJabatans = Jabatan::aktif()
            ->where('id', '!=', $jabatan->id)
            ->orderBy('urutan')
            ->orderBy('nama')
            ->get();

        return view(
            'admin.referensi.jabatan.edit',
            compact('jabatan', 'parentJabatans')
        );
    }

    public function update(UpdateJabatanRequest $request, Jabatan $jabatan)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($request->nama);

        $data['is_penandatangan'] = $request->boolean('is_penandatangan');
        $data['is_struktur']      = $request->boolean('is_struktur');
        $data['aktif']            = $request->boolean('aktif');

        $jabatan->update($data);

        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil diperbarui.');
    }

    public function destroy(Jabatan $jabatan)
    {
        if ($jabatan->perangkat()->exists()) {

            return back()->with(
                'error',
                'Jabatan tidak dapat dihapus karena masih digunakan oleh perangkat.'
            );

        }

        if ($jabatan->children()->exists()) {

            return back()->with(
                'error',
                'Jabatan tidak dapat dihapus karena masih memiliki jabatan turunan.'
            );

        }

        $jabatan->delete();

        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil dihapus.');
    }
}