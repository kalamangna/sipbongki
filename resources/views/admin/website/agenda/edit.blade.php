@extends('layouts.admin')


@section('title', 'Edit Agenda')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">


        <div>

            <h3 class="font-bold mb-1">
                Edit Agenda
            </h3>

            <p class="text-slate-500 mb-0">
                Perbarui informasi kegiatan Kelurahan Bongki.
            </p>

        </div>



        <a href="{{ route('admin.website.agenda.index') }}"
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

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif





    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


        <div class="p-6">



            <form action="{{ route('admin.website.agenda.update',$agenda->id) }}"
                  method="POST">


                @csrf

                @method('PUT')





                {{-- JUDUL --}}
                <div class="mb-4">


                    <label class="form-label fw-semibold">

                        Judul Kegiatan

                    </label>


                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul',$agenda->judul) }}"
                           required>


                </div>







                {{-- DESKRIPSI --}}
                <div class="mb-4">


                    <label class="form-label fw-semibold">

                        Deskripsi

                    </label>


                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="form-control">{{ old('deskripsi',$agenda->deskripsi) }}</textarea>


                </div>







                <div class="flex flex-wrap -mx-3">


                    {{-- TANGGAL --}}
                    <div class="col-md-4 mb-4">


                        <label class="form-label fw-semibold">

                            Tanggal

                        </label>


                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               value="{{ old('tanggal',$agenda->tanggal?->format('Y-m-d')) }}"
                               required>


                    </div>





                    {{-- WAKTU --}}
                    <div class="col-md-4 mb-4">


                        <label class="form-label fw-semibold">

                            Waktu

                        </label>


                        <input type="time"
                               name="waktu"
                               class="form-control"
                               value="{{ old('waktu',$agenda->waktu) }}">


                    </div>






                    {{-- LOKASI --}}
                    <div class="col-md-4 mb-4">


                        <label class="form-label fw-semibold">

                            Lokasi Kegiatan

                        </label>


                        <input type="text"
                               name="lokasi"
                               class="form-control"
                               value="{{ old('lokasi',$agenda->lokasi) }}">


                    </div>


                </div>








                {{-- STATUS --}}
                <div class="mb-6">


                    <label class="form-label fw-semibold">

                        Status

                    </label>



                    <select name="status"
                            class="form-select">


                        <option value="aktif"
                            {{ old('status',$agenda->status)=='aktif' ? 'selected':'' }}>

                            Aktif

                        </option>


                        <option value="nonaktif"
                            {{ old('status',$agenda->status)=='nonaktif' ? 'selected':'' }}>

                            Nonaktif

                        </option>


                    </select>


                </div>







                {{-- BUTTON --}}
                <div class="text-end">


                    <a href="{{ route('admin.website.agenda.index') }}"
                       class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 shadow-sm mr-2">

                        Batal

                    </a>



                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">


                        <i class="bi bi-save mr-2"></i>

                        Simpan Perubahan


                    </button>


                </div>



            </form>



        </div>


    </div>



</div>


@endsection