@extends('layouts.admin')

@section('title', 'Edit Berita')


@section('content')

<div class="container-fluid">


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h3 class="fw-bold mb-1">
                Edit Berita
            </h3>


            <p class="text-muted mb-0">
                Perbarui informasi berita Kelurahan Bongki.
            </p>

        </div>



        <a href="{{ route('admin.website.berita.index') }}"
           class="btn btn-outline-secondary">

            <i class="fa-solid fa-arrow-left"></i>

            Kembali

        </a>


    </div>





    {{-- FORM --}}

    <div class="card border-0 shadow-sm">


        <div class="card-body">


            <form action="{{ route('admin.website.berita.update', $berita->id) }}"
                  method="POST"
                  enctype="multipart/form-data">


                @csrf

                @method('PUT')



                {{-- JUDUL --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Judul Berita
                    </label>


                    <input type="text"
                           name="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $berita->judul) }}">


                    @error('judul')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror


                </div>





                {{-- ISI --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Isi Berita
                    </label>


                    <textarea
                        name="isi"
                        rows="8"
                        class="form-control @error('isi') is-invalid @enderror">{{ old('isi', $berita->isi) }}</textarea>



                    @error('isi')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror


                </div>





                {{-- GAMBAR LAMA --}}

                @if($berita->gambar)

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Gambar Saat Ini
                    </label>


                    <br>


                    <img src="{{ asset('storage/'.$berita->gambar) }}"
                         width="220"
                         class="rounded shadow-sm">


                </div>

                @endif






                {{-- GAMBAR BARU --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Ganti Gambar
                    </label>


                    <input type="file"
                           name="gambar"
                           class="form-control @error('gambar') is-invalid @enderror">


                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti gambar.
                    </small>



                    @error('gambar')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                    @enderror


                </div>







                {{-- STATUS --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Status Publikasi
                    </label>


                    <select name="status"
                            class="form-select">


                        <option value="draft"
                            {{ $berita->status == 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>


                        <option value="publish"
                            {{ $berita->status == 'publish' ? 'selected' : '' }}>
                            Publish
                        </option>


                    </select>


                </div>







                {{-- TANGGAL --}}

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Tanggal Publish
                    </label>


                    <input type="date"
                           name="tanggal_publish"
                           class="form-control"
                           value="{{ old(
                               'tanggal_publish',
                               optional($berita->tanggal_publish)->format('Y-m-d')
                           ) }}">


                </div>







                <button type="submit"
                        class="btn btn-primary">


                    <i class="fa-solid fa-floppy-disk"></i>

                    Simpan Perubahan


                </button>



            </form>


        </div>


    </div>


</div>


@endsection