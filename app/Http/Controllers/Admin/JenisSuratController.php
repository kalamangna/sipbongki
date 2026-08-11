<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJenisSuratRequest;
use App\Http\Requests\UpdateJenisSuratRequest;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $jenisSurats = JenisSurat::when($search, function ($query) use ($search) {
                $query->where('kode', 'like', "%{$search}%")
                      ->orWhere('nama', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.referensi.jenis-surat.index',
            compact('jenisSurats', 'search')
        );
    }

    public function create()
    {
        return view('admin.referensi.jenis-surat.create');
    }

    public function store(StoreJenisSuratRequest $request)
    {
        $data = $request->validated();

        $data['aktif'] = $request->boolean('aktif');

        JenisSurat::create($data);

        return redirect()
            ->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil ditambahkan.');
    }

    public function show(JenisSurat $jenisSurat)
    {
        //
    }

    public function edit(JenisSurat $jenisSurat)
    {
        return view(
            'admin.referensi.jenis-surat.edit',
            compact('jenisSurat')
        );
    }

    public function update(UpdateJenisSuratRequest $request, JenisSurat $jenisSurat)
    {
        $data = $request->validated();
        

        $data['aktif'] = $request->boolean('aktif');

        $jenisSurat->update($data);

        return redirect()
            ->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil diperbarui.');
    }

    public function destroy(JenisSurat $jenisSurat)
    {
        $jenisSurat->delete();

        return redirect()
            ->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil dihapus.');
    }
}