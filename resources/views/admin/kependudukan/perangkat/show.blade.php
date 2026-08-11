@extends('layouts.admin')

@section('title', 'Profil Perangkat Kelurahan')

@section('content')

<div class="container-fluid">


    <div class="flex justify-between items-center mb-4">

        <div>
            <p class="text-slate-500 mb-0">
                Informasi Lengkap Pejabat Kelurahan
            </p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('admin.perangkat.index') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">

                <i class="bi bi-arrow-left"></i>
                Kembali

            </a>

            <a href="{{ route('admin.perangkat.edit',$perangkat) }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm">

                <i class="bi bi-pencil"></i>
                Edit

            </a>

            <form action="{{ route('admin.perangkat.destroy', $perangkat) }}"
                  method="POST"
                  class="d-inline">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm"
                        onclick="return confirm('Yakin ingin menghapus data pejabat kelurahan ini?')">
                    <i class="bi bi-trash"></i>
                    Hapus
                </button>

            </form>
        </div>

    </div>

    <div class="flex flex-wrap -mx-3">


        <!-- FOTO PROFIL -->

        <div class="w-full lg:w-1/3 px-3">


            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm text-center mb-4">


                <div class="p-6">


                    @if($perangkat->foto)


                        <img
                            src="{{ asset('storage/'.$perangkat->foto) }}"
                            class="rounded-circle mb-4 mx-auto d-block"
                            width="180"
                            height="180"
                            style="object-fit:cover;">


                    @else


                        <img
                            src="{{ asset('images/avatar-default.png') }}"
                            class="rounded-circle mb-4 mx-auto d-block"
                            width="180"
                            height="180"
                            style="object-fit:cover;">


                    @endif



                    <h4 class="mb-1">

                        {{ $perangkat->nama_lengkap }}

                    </h4>


                    <p class="text-slate-500">

                        {{ $perangkat->jabatan->nama ?? '-' }}

                    </p>



                    @if($perangkat->aktif)


                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

                            Aktif Menjabat

                        </span>


                    @else


                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

                            Tidak Aktif

                        </span>


                    @endif



                </div>


            </div>


        </div>




        <!-- DATA PROFIL -->

        <div class="w-full lg:w-2/3 px-3">


            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">


                <div class="px-6 py-4 border-b border-slate-200">

                    <strong>
                        Informasi Pejabat :
                    </strong>

                </div>


                <div class="p-6">


                    <table class="w-full text-left border-collapse text-sm">


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




</div>


@endsection