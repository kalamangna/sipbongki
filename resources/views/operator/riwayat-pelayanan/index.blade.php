@extends('layouts.operator')

@section('title','Riwayat Pelayanan')

@section('subtitle','Riwayat layanan administrasi Kelurahan Bongki')


@section('content')

<div class="card shadow-sm">

    <div class="card-body">


        <div class="table-responsive">

            <table class="table table-hover">

                <thead>

                    <tr>
                        <th>Nama</th>
                        <th>Jenis Surat</th>
                        <th>Status</th>
                    </tr>

                </thead>


                <tbody>


                @forelse($riwayat as $item)

                <tr>

                    <td>
                        {{ optional($item->penduduk)->nama_lengkap }}
                    </td>


                    <td>
                        {{ optional($item->jenisSurat)->nama }}
                    </td>


                    <td>
                        {{ $item->status }}
                    </td>

                </tr>


                @empty

                <tr>

                    <td colspan="3" class="text-center">

                        Belum ada riwayat pelayanan.

                    </td>

                </tr>

                @endforelse


                </tbody>

            </table>

        </div>


    </div>

</div>

@endsection