@extends('layouts.admin')

@section('title', 'Profil Perangkat Kelurahan')

@section('content')

<div class="container-fluid">


    <div class="mb-3">

        
        <p class="text-muted">
            Informasi Lengkap Pejabat Kelurahan
        </p>

    </div>



    <div class="row">


        <!-- FOTO PROFIL -->

        <div class="col-lg-4">


            <div class="card shadow-sm text-center mb-3">


                <div class="card-body">


                    @if($perangkat->foto)


                        <img
                            src="{{ asset('storage/'.$perangkat->foto) }}"
                            class="rounded-circle mb-3"
                            width="180"
                            height="180"
                            style="object-fit:cover;">


                    @else


                        <img
                            src="{{ asset('images/avatar-default.png') }}"
                            class="rounded-circle mb-3"
                            width="180"
                            height="180"
                            style="object-fit:cover;">


                    @endif



                    <h4 class="mb-1">

                        {{ $perangkat->nama_lengkap }}

                    </h4>


                    <p class="text-muted">

                        {{ $perangkat->jabatan->nama ?? '-' }}

                    </p>



                    @if($perangkat->aktif)


                        <span class="badge bg-success">

                            Aktif Menjabat

                        </span>


                    @else


                        <span class="badge bg-secondary">

                            Tidak Aktif

                        </span>


                    @endif



                </div>


            </div>


        </div>




        <!-- DATA PROFIL -->

        <div class="col-lg-8">


            <div class="card shadow-sm">


                <div class="card-header">

                    <strong>
                        Informasi Pejabat :
                    </strong>

                </div>


                <div class="card-body">


                    <table class="table">


                        <tr>

                            <th width="35%">
                                Nama Lengkap:
                            </th>

                            <td>
                                {{ $perangkat->nama_lengkap }}
                            </td>

                        </tr>



                        <tr>

                            <th>
                                NIP :
                            </th>

                            <td>
                                {{ $perangkat->nip ?? '-' }}
                            </td>

                        </tr>



                        <tr>

                            <th>
                                Jabatan :
                            </th>

                            <td>
                                {{ $perangkat->jabatan->nama ?? '-' }}
                            </td>

                        </tr>



                        <tr>

                            <th>
                                Jenis Kelamin :
                            </th>

                            <td>

                                @if($perangkat->jenis_kelamin == 'L')

                                    Laki-laki

                                @elseif($perangkat->jenis_kelamin == 'P')

                                    Perempuan

                                @else

                                    -

                                @endif

                            </td>

                        </tr>



                        <tr>

                            <th>
                                Tempat / Tanggal Lahir :
                            </th>

                            <td>

                                {{ $perangkat->tempat_lahir ?? '-' }}

                                /

                                {{ optional($perangkat->tanggal_lahir)->format('d-m-Y') }}

                            </td>

                        </tr>



                        <tr>

                            <th>
                                Pendidikan :
                            </th>

                            <td>
                                {{ $perangkat->pendidikan ?? '-' }}
                            </td>

                        </tr>



                        <tr>

                            <th>
                                Nomor HP :
                            </th>

                            <td>
                                {{ $perangkat->telepon ?? '-' }}
                            </td>

                        </tr>



                        <tr>

                            <th>
                                Email :
                            </th>

                            <td>
                                {{ $perangkat->email ?? '-' }}
                            </td>

                        </tr>



                        <tr>

                            <th>
                                Alamat :
                            </th>

                            <td>
                                {{ $perangkat->alamat ?? '-' }}
                            </td>

                        </tr>



                        <tr>

                            <th>
                                Mulai Menjabat :
                            </th>

                            <td>

                                {{ optional($perangkat->tanggal_mulai_jabatan)
                                    ->format('d-m-Y') }}

                            </td>

                        </tr>



                        <tr>

                            <th>
                                Keterangan :
                            </th>

                            <td>

                                {{ $perangkat->keterangan ?? '-' }}

                            </td>

                        </tr>



                    </table>


                </div>


            </div>


        </div>


    </div>




    <div class="mt-3">

        <a href="{{ route('admin.perangkat.index') }}"
           class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left"></i>

            Kembali

        </a>


        <a href="{{ route('admin.perangkat.edit',$perangkat) }}"
           class="btn btn-warning">

            <i class="fa-solid fa-pen"></i>

            Edit

        </a>


    </div>


</div>


@endsection