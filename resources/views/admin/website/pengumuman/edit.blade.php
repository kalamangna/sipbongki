@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                Edit Pengumuman
            </h3>

            <p class="text-muted mb-0">
                Perbarui informasi pengumuman Kelurahan Bongki.
            </p>

        </div>

        <a href="{{ route('admin.website.pengumuman.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-2"></i>

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

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form action="{{ route('admin.website.pengumuman.update', $pengumuman) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- JUDUL --}}
                <div class="mb-3">

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
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Isi Pengumuman
                    </label>

                    <textarea
                        name="isi"
                        rows="8"
                        class="form-control"
                        placeholder="Tuliskan isi pengumuman">{{ old('isi', $pengumuman->isi) }}</textarea>

                </div>

                <div class="row">

                    {{-- GAMBAR --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Gambar Pengumuman
                        </label>

                        <input
                            type="file"
                            name="gambar"
                            class="form-control">

                        <small class="text-muted">
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
                    <div class="col-md-3 mb-3">

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
                    <div class="col-md-3 mb-3">

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
                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-save me-2"></i>

                        Update Pengumuman

                    </button>

                    <a href="{{ route('admin.website.pengumuman.index') }}"
                       class="btn btn-light">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection