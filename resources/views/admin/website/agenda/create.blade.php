@extends('layouts.admin')


@section('title', 'Tambah Agenda')


@section('content')


<div class="container-fluid">



    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">


        <div>

            <h3 class="font-bold mb-1">
                Tambah Agenda
            </h3>


            <p class="text-slate-500 mb-0">
                Tambahkan jadwal kegiatan Kelurahan Bongki.
            </p>


        </div>





        <a href="{{ route('admin.website.agenda.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-outline-secondary">


            <i class="bi bi-arrow-left mr-2"></i>

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







    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


        <div class="p-6">



            <form action="{{ route('admin.website.agenda.store') }}"
                  method="POST">


                @csrf






                {{-- JUDUL --}}

                <div class="mb-4">


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

                <div class="mb-4">


                    <label class="form-label fw-semibold">

                        Deskripsi Kegiatan

                    </label>



                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="form-control"
                        placeholder="Jelaskan kegiatan agenda">{{ old('deskripsi') }}</textarea>



                </div>









                <div class="flex flex-wrap -mx-3">



                    {{-- TANGGAL --}}

                    <div class="w-full md:w-1/2 px-3 mb-4">


                        <label class="form-label fw-semibold">

                            Tanggal

                        </label>



                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               value="{{ old('tanggal') }}">



                    </div>








                    {{-- WAKTU --}}

                    <div class="w-full md:w-1/2 px-3 mb-4">


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

                <div class="mb-4">


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

                <div class="mb-6">


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
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">


                    <i class="bi bi-save mr-2"></i>

                    Simpan Agenda


                </button>



            </form>



        </div>


    </div>




</div>


@endsection