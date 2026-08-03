@extends('layouts.admin')


@section('title', 'Manajemen Agenda')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            
            <p class="text-muted mb-0">
                Kelola jadwal kegiatan Kelurahan Bongki.
            </p>

        </div>



        <a href="{{ route('admin.website.agenda.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle me-2"></i>

            Tambah Agenda

        </a>


    </div>





   




    {{-- CARD TABLE --}}
    <div class="card border-0 shadow-sm">


        <div class="card-body">


            <div class="table-responsive">


                <table class="table table-hover align-middle">


                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Kegiatan
                            </th>

                            <th width="130">
                                Tanggal
                            </th>

                            <th width="120">
                                Waktu
                            </th>

                            <th>
                                Lokasi
                            </th>

                            <th width="120">
                                Status
                            </th>

                            <th width="150">
                                Aksi
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                    @forelse($agendas as $index => $agenda)


                        <tr>


                            <td>

                                {{ $agendas->firstItem() + $index }}

                            </td>




                            <td>


                                <strong>

                                    {{ $agenda->judul }}

                                </strong>


                                <br>


                                <small class="text-muted">

                                    {{ Str::limit($agenda->deskripsi, 70) }}

                                </small>


                            </td>




                            <td>


                                {{ $agenda->tanggal
                                    ? $agenda->tanggal->format('d M Y')
                                    : '-'
                                }}


                            </td>





                            <td>


                                {{ $agenda->waktu ?? '-' }}


                                WITA


                            </td>





                            <td>


                                <i class="bi bi-geo-alt text-primary me-1"></i>


                                {{ $agenda->lokasi ?? '-' }}


                            </td>





                            <td>


                                @if($agenda->status == 'aktif')


                                    <span class="badge bg-success">

                                        Aktif

                                    </span>


                                @else


                                    <span class="badge bg-secondary">

                                        Nonaktif

                                    </span>


                                @endif


                            </td>






                           
<td class="text-center">

    <div class="action-buttons">

        {{-- Detail --}}
        <a href="{{ route('admin.website.agenda.show',$agenda->id) }}"
           class="btn btn-info btn-sm"
           title="Detail">

            <i class="bi bi-eye"></i>

        </a>

        {{-- Edit --}}
        <a href="{{ route('admin.website.agenda.edit',$agenda->id) }}"
           class="btn btn-warning btn-sm"
           title="Edit">

            <i class="bi bi-pencil"></i>

        </a>

        {{-- Hapus --}}
        <form action="{{ route('admin.website.agenda.destroy',$agenda->id) }}"
              method="POST"
              class="d-inline m-0">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger btn-sm"
                title="Hapus"
                onclick="return confirm('Hapus agenda ini?')">

                <i class="bi bi-trash"></i>

            </button>

        </form>

    </div>

</td>


                        </tr>



                    @empty


                        <tr>

                            <td colspan="7"
                                class="text-center text-muted py-4">


                                Belum ada agenda.


                            </td>

                        </tr>


                    @endforelse



                    </tbody>



                </table>


            </div>





            {{ $agendas->links() }}



        </div>


    </div>



</div>


@endsection