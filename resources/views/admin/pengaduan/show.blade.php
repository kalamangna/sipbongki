@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">

        <div>

            <h4 class="mb-1 complaint-detail-page-title">
                Detail Pengaduan
            </h4>

            <p class="text-slate-500 mb-0">
                Informasi lengkap laporan masyarakat.
            </p>

        </div>

        <a href="{{ route('admin.pengaduan.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>

    </div>

    <div class="flex flex-wrap -mx-3">

        {{-- Informasi Pengaduan --}}
        <div class="w-full lg:w-2/3 px-3">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

                <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header">

                    <h5 class="mb-0 complaint-detail-card-title">
                        Informasi Pengaduan
                    </h5>

                </div>

                <div class="p-6">

                    <table class="w-full text-left border-collapse text-sm table-borderless complaint-detail-table">

                        <tr>
                            <th width="220">Kode Pengaduan</th>
                            <td>{{ $pengaduan->kode }}</td>
                        </tr>

                        <tr>
                            <th>Nama Pelapor</th>
                            <td>{{ $pengaduan->nama }}</td>
                        </tr>

                        <tr>
                            <th>NIK Pelapor</th>
                            <td>{{ $pengaduan->nik_pelapor ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>No. WhatsApp</th>
                            <td>{{ $pengaduan->telepon }}</td>
                        </tr>

                        <tr>
                            <th>Alamat</th>
                            <td>{{ $pengaduan->alamat }}</td>
                        </tr>

                        <tr>
                            <th>Catatan Petugas</th>
                            <td>{{ $pengaduan->catatan ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Kategori</th>
                            <td>{{ $pengaduan->kategori }}</td>
                        </tr>

                        <tr>
                            <th>Lokasi Kejadian</th>
                            <td>{{ $pengaduan->lokasi }}</td>
                        </tr>

                        <tr>
                            <th>Tanggal Laporan</th>
                            <td>

                                {{ $pengaduan->created_at->timezone('Asia/Makassar')->format('d F Y H:i') }} WITA

                                <br>

                                <small class="text-slate-500">

                                    {{ $pengaduan->created_at->format('H:i') }} WITA

                                </small>

                            </td>
                        </tr>

                    </table>

                </div>

            </div>

            {{-- Uraian --}}
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

                <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header">

                    <h5 class="mb-0 complaint-detail-card-title">

                        Uraian Pengaduan

                    </h5>

                </div>

                <div class="p-6">

                    {!! nl2br(e($pengaduan->uraian)) !!}

                </div>

            </div>

        </div>

        {{-- Sidebar --}}
        <div class="w-full lg:w-1/3 px-3">

            {{-- Foto --}}
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

                <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header">

                    <h5 class="mb-0 complaint-detail-card-title">

                        Foto Bukti

                    </h5>

                </div>

                <div class="p-6 text-center">

                    @if($pengaduan->foto)

                        <img
                            src="{{ asset('storage/'.$pengaduan->foto) }}"
                            class="img-fluid rounded shadow-sm">

                    @else

                        <div class="text-slate-500 py-8">

                            <i class="bi bi-image fs-1 d-block mb-4"></i>

                            Tidak ada foto.

                        </div>

                    @endif

                </div>

            </div>

            {{-- Aksi Penanganan --}}
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

                <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header complaint-detail-action-header">

                    <h5 class="mb-0 complaint-detail-card-title">

                        Aksi Pengaduan

                    </h5>

                </div>

                <div class="p-6">

                    @if($pengaduan->status == 'Baru')

                        <div class="d-grid gap-3 mb-6">

                            <form
                                action="{{ route('admin.pengaduan.update',$pengaduan) }}"
                                method="POST">

                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="status" value="Diproses">

                                <button
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm btn-lg w-100"
                                    onclick="return confirm('Proses pengaduan ini?')">

                                    <i class="bi bi-play-circle mr-2"></i>

                                    Proses Pengaduan

                                </button>

                            </form>

                            <form
                                action="{{ route('admin.pengaduan.update',$pengaduan) }}"
                                method="POST">

                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="status" value="Selesai">

                                <button
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm btn-lg w-100"
                                    onclick="return confirm('Tandai pengaduan ini sebagai selesai?')">

                                    <i class="bi bi-check-circle mr-2"></i>

                                    Selesaikan Pengaduan

                                </button>

                            </form>

                        </div>

                    @elseif($pengaduan->status == 'Diproses')

                        <div class="d-grid gap-3 mb-6">

                            <form
                                action="{{ route('admin.pengaduan.update',$pengaduan) }}"
                                method="POST">

                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="status" value="Selesai">

                                <button
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm btn-lg w-100"
                                    onclick="return confirm('Selesaikan pengaduan ini?')">

                                    <i class="bi bi-check-circle mr-2"></i>

                                    Selesaikan Pengaduan

                                </button>

                            </form>

                        </div>

                    @endif

                    <a
                        href="{{ route('admin.pengaduan.edit',$pengaduan) }}"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm btn-lg w-100 mb-6">

                        <i class="bi bi-pencil mr-2"></i>

                        Edit Pengaduan

                    </a>

                    <form
                        action="{{ route('admin.pengaduan.update',$pengaduan) }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-4">

                            <label class="form-label">

                                Status

                            </label>

                            <select
                                name="status"
                                class="form-select">

                                <option
                                    value="Baru"
                                    @selected($pengaduan->status=='Baru')>

                                    Baru

                                </option>

                                <option
                                    value="Diproses"
                                    @selected($pengaduan->status=='Diproses')>

                                    Diproses

                                </option>

                                <option
                                    value="Selesai"
                                    @selected($pengaduan->status=='Selesai')>

                                    Selesai

                                </option>

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Catatan Petugas

                            </label>

                            <textarea
                                name="catatan"
                                rows="5"
                                class="form-control">{{ old('catatan',$pengaduan->catatan) }}</textarea>

                        </div>

                        <button
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm btn-lg w-100">

                            <i class="bi bi-check-circle mr-2"></i>

                            Simpan Perubahan

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection