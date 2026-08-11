@extends('layouts.admin')


@section('title', 'Tambah Galeri')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">


        <div>

            <h3 class="font-bold mb-1">
                Tambah Galeri
            </h3>

            <p class="text-slate-500 mb-0">
                Tambahkan dokumentasi kegiatan Kelurahan Bongki.
            </p>

        </div>



        <a href="{{ route('admin.website.galeri.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">


            <i class="bi bi-arrow-left mr-2"></i>

            Kembali


        </a>


    </div>








    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


        <div class="p-6">


            <form action="{{ route('admin.website.galeri.store') }}"
                  method="POST"
                  enctype="multipart/form-data">


                @csrf





                {{-- JUDUL --}}

                <div class="mb-4">


                    <label class="form-label fw-semibold">

                        Judul Dokumentasi

                    </label>


                    <input type="text"
                           name="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul') }}"
                           placeholder="Contoh: Gotong Royong Bersama Warga">


                    @error('judul')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror


                </div>








                {{-- DESKRIPSI --}}

                <div class="mb-4">


                    <label class="form-label fw-semibold">

                        Deskripsi

                    </label>


                    <textarea name="deskripsi"
                              rows="4"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              placeholder="Keterangan dokumentasi">{{ old('deskripsi') }}</textarea>



                    @error('deskripsi')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror


                </div>










                {{-- GAMBAR --}}

                <div class="mb-4">


                    <label class="form-label fw-semibold">

                        Foto Dokumentasi

                    </label>



                    <input type="file"
                           name="gambar"
                           class="form-control @error('gambar') is-invalid @enderror"
                           accept="image/*"
                           onchange="previewImage(event)">



                    @error('gambar')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror





                    <div class="mt-3">


                        <img id="preview"
                             src="#"
                             class="rounded d-none"
                             width="250"
                             height="160"
                             style="object-fit:cover;">


                    </div>



                </div>









                {{-- STATUS --}}

                <div class="mb-6">


                    <label class="form-label fw-semibold">

                        Status Publikasi

                    </label>



                    <select name="status"
                            class="form-select">


                        <option value="aktif">

                            Aktif

                        </option>


                        <option value="nonaktif">

                            Nonaktif

                        </option>


                    </select>


                </div>









                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">


                    <i class="bi bi-save mr-2"></i>

                    Simpan Galeri


                </button>



            </form>


        </div>


    </div>


</div>







{{-- PREVIEW IMAGE --}}

<script>

function previewImage(event)
{

    const image = document.getElementById('preview');

    image.src = URL.createObjectURL(
        event.target.files[0]
    );

    image.classList.remove('d-none');

}

</script>



@endsection