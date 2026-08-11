@extends('layouts.admin')

@section('title', 'Edit Pengaduan')

@section('content')

<div class="container-fluid">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h3 class="font-bold mb-1">
                Edit Pengaduan
            </h3>

            <p class="text-slate-500 mb-0">
                Perbarui status dan catatan pengaduan.
            </p>

        </div>

        <a href="{{ route('admin.pengaduan.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>

    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

        <div class="p-6">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error Validasi</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('admin.pengaduan.update', $pengaduan) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="Baru" @selected($pengaduan->status=='Baru')>Baru</option>
                        <option value="Diproses" @selected($pengaduan->status=='Diproses')>Diproses</option>
                        <option value="Selesai" @selected($pengaduan->status=='Selesai')>Selesai</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Catatan Petugas</label>
                    <textarea name="catatan" rows="5" class="form-control">{{ old('catatan', $pengaduan->catatan) }}</textarea>
                </div>

                <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">
                    <i class="bi bi-save mr-2"></i>
                    Simpan Perubahan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
