@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">

        <div>

            <h3 class="font-bold mb-1">
                Edit Pengumuman
            </h3>

            <p class="text-slate-500 mb-0">
                Perbarui informasi pengumuman Kelurahan Bongki.
            </p>

        </div>

        <a href="{{ route('admin.website.pengumuman.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">

            <i class="bi bi-arrow-left mr-2"></i>

            Kembali

        </a>

    </div>

    {{-- VALIDATION ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

        <div class="p-6">

            <form action="{{ route('admin.website.pengumuman.update', $pengumuman) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- JUDUL --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Judul Pengumuman
                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="{{ old('judul', $pengumuman->judul) }}"
                        placeholder="Masukkan judul pengumuman">

                </div>

                {{-- ISI --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Isi Pengumuman
                    </label>

                    <textarea
                        name="isi"
                        rows="8"
                        class="form-control"
                        placeholder="Tuliskan isi pengumuman">{{ old('isi', $pengumuman->isi) }}</textarea>

                </div>

                <div class="flex flex-wrap -mx-3">

                    {{-- GAMBAR --}}
                    <div class="w-full md:w-1/2 px-3 mb-4">

                        <label class="form-label fw-semibold">
                            Gambar Pengumuman
                        </label>

                        <input
                            type="file"
                            name="gambar"
                            class="form-control">

                        <small class="text-slate-500">
                            Format JPG, PNG maksimal 2MB.
                        </small>

                        @if($pengumuman->gambar)

                            <div class="mt-3">

                                <img
                                    src="{{ asset('storage/'.$pengumuman->gambar) }}"
                                    class="img-thumbnail"
                                    style="max-width:220px;">

                            </div>

                        @endif

                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-3 mb-4">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="draft"
                                {{ old('status', $pengumuman->status) == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="publish"
                                {{ old('status', $pengumuman->status) == 'publish' ? 'selected' : '' }}>
                                Publish
                            </option>

                        </select>

                    </div>

                    {{-- TANGGAL --}}
                    <div class="col-md-3 mb-4">

                        <label class="form-label fw-semibold">
                            Tanggal Publish
                        </label>

                        <input
                            type="date"
                            name="tanggal_publish"
                            class="form-control"
                            value="{{ old('tanggal_publish', optional($pengumuman->tanggal_publish)->format('Y-m-d')) }}">

                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="mt-6">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

                        <i class="bi bi-save mr-2"></i>

                        Update Pengumuman

                    </button>

                    <a href="{{ route('admin.website.pengumuman.index') }}"
                       class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 shadow-sm">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection