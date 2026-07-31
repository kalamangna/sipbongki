@extends('layouts.admin')


@section('title', 'Edit Galeri')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h3 class="fw-bold mb-1">
                Edit Galeri
            </h3>

            <p class="text-muted mb-0">
                Perbarui dokumentasi kegiatan Kelurahan Bongki.
            </p>

        </div>



        <a href="{{ route('admin.website.galeri.index') }}"
           class="btn btn-secondary">


            <i class="bi bi-arrow-left me-2"></i>

            Kembali


        </a>


    </div>







    <div class="card border-0 shadow-sm">


        <div class="card-body">



            <form action="{{ route('admin.website.galeri.update',$galeri->id) }}"
                  method="POST"
                  enctype="multipart/form-data">


                @csrf

                @method('PUT')







                {{-- JUDUL --}}

                <div class="mb-3">


                    <label class="form-label fw-semibold">
                        Judul Dokumentasi
                    </label>


                    <input type="text"
                           name="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul',$galeri->judul) }}">



                    @error('judul')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>










                {{-- DESKRIPSI --}}

                <div class="mb-3">


                    <label class="form-label fw-semibold">
                        Deskripsi
                    </label>


                    <textarea name="deskripsi"
                              rows="4"
                              class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi',$galeri->deskripsi) }}</textarea>



                    @error('deskripsi')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>










                {{-- GAMBAR LAMA --}}

                <div class="mb-3">


                    <label class="form-label fw-semibold">
                        Foto Saat Ini
                    </label>


                    <br>


                    <img src="{{ asset('storage/'.$galeri->gambar) }}"
                         width="250"
                         height="160"
                         class="rounded mb-3"
                         style="object-fit:cover;">


                </div>









                {{-- UPLOAD GAMBAR BARU --}}

                <div class="mb-3">


                    <label class="form-label fw-semibold">
                        Ganti Foto (Opsional)
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

                <div class="mb-4">


                    <label class="form-label fw-semibold">
                        Status
                    </label>


                    <select name="status"
                            class="form-select">


                        <option value="aktif"
                            {{ $galeri->status == 'aktif' ? 'selected' : '' }}>

                            Aktif

                        </option>



                        <option value="nonaktif"
                            {{ $galeri->status == 'nonaktif' ? 'selected' : '' }}>

                            Nonaktif

                        </option>


                    </select>


                </div>








                <button type="submit"
                        class="btn btn-primary">


                    <i class="bi bi-save me-2"></i>

                    Update Galeri


                </button>




            </form>



        </div>


    </div>


</div>









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