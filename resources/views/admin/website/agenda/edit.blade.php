@extends('layouts.admin')


@section('title', 'Edit Agenda')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h3 class="fw-bold mb-1">
                Edit Agenda
            </h3>

            <p class="text-muted mb-0">
                Perbarui informasi kegiatan Kelurahan Bongki.
            </p>

        </div>



        <a href="{{ route('admin.website.agenda.index') }}"
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

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif





    <div class="card border-0 shadow-sm">


        <div class="card-body">



            <form action="{{ route('admin.website.agenda.update',$agenda->id) }}"
                  method="POST">


                @csrf

                @method('PUT')





                {{-- JUDUL --}}
                <div class="mb-3">


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
                <div class="mb-3">


                    <label class="form-label fw-semibold">

                        Deskripsi

                    </label>


                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="form-control">{{ old('deskripsi',$agenda->deskripsi) }}</textarea>


                </div>







                <div class="row">


                    {{-- TANGGAL --}}
                    <div class="col-md-4 mb-3">


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
                    <div class="col-md-4 mb-3">


                        <label class="form-label fw-semibold">

                            Waktu

                        </label>


                        <input type="time"
                               name="waktu"
                               class="form-control"
                               value="{{ old('waktu',$agenda->waktu) }}">


                    </div>






                    {{-- LOKASI --}}
                    <div class="col-md-4 mb-3">


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
                <div class="mb-4">


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
                       class="btn btn-light me-2">

                        Batal

                    </a>



                    <button type="submit"
                            class="btn btn-primary">


                        <i class="bi bi-save me-2"></i>

                        Simpan Perubahan


                    </button>


                </div>



            </form>



        </div>


    </div>



</div>


@endsection