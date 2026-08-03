@extends('layouts.admin')


@section('title', 'Tambah Agenda')


@section('content')


<div class="container-fluid">



    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h3 class="fw-bold mb-1">
                Tambah Agenda
            </h3>


            <p class="text-muted mb-0">
                Tambahkan jadwal kegiatan Kelurahan Bongki.
            </p>


        </div>





        <a href="{{ route('admin.website.agenda.index') }}"
           class="btn btn-outline-secondary">


            <i class="fa-solid fa-arrow-left me-2"></i>

            Kembali


        </a>


    </div>







    {{-- VALIDATION ERROR --}}

    @if($errors->any())

        <div class="alert alert-danger">


            <strong>
                Terjadi kesalahan:
            </strong>


            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>


        </div>

    @endif







    <div class="card border-0 shadow-sm">


        <div class="card-body">



            <form action="{{ route('admin.website.agenda.store') }}"
                  method="POST">


                @csrf






                {{-- JUDUL --}}

                <div class="mb-3">


                    <label class="form-label fw-semibold">

                        Judul Agenda

                    </label>



                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul') }}"
                           placeholder="Contoh: Musyawarah Kelurahan">



                </div>









                {{-- DESKRIPSI --}}

                <div class="mb-3">


                    <label class="form-label fw-semibold">

                        Deskripsi Kegiatan

                    </label>



                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="form-control"
                        placeholder="Jelaskan kegiatan agenda">{{ old('deskripsi') }}</textarea>



                </div>









                <div class="row">



                    {{-- TANGGAL --}}

                    <div class="col-md-6 mb-3">


                        <label class="form-label fw-semibold">

                            Tanggal

                        </label>



                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               value="{{ old('tanggal') }}">



                    </div>








                    {{-- WAKTU --}}

                    <div class="col-md-6 mb-3">


                        <label class="form-label fw-semibold">

                            Waktu

                        </label>



                        <input type="time"
                               name="waktu"
                               class="form-control"
                               value="{{ old('waktu') }}">



                    </div>



                </div>









                {{-- TEMPAT --}}

                <div class="mb-3">


                    <label class="form-label fw-semibold">

                        Tempat Kegiatan

                    </label>



                    <input type="text"
                           name="lokasi"
                           class="form-control"
                           value="{{ old('tempat') }}"
                           placeholder="Contoh: Aula Kelurahan Bongki">



                </div>









                {{-- STATUS --}}

                <div class="mb-4">


                    <label class="form-label fw-semibold">

                        Status Publikasi

                    </label>



                    <select name="status"
                            class="form-select">



                        <option value="aktif"
                            {{ old('status') == 'aktif' ? 'selected' : '' }}>

                            Aktif

                        </option>




                        <option value="nonaktif"
                            {{ old('status') == 'nonaktif' ? 'selected' : '' }}>

                            Nonaktif

                        </option>



                    </select>



                </div>









                <button type="submit"
                        class="btn btn-primary">


                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    Simpan Agenda


                </button>



            </form>



        </div>


    </div>




</div>


@endsection