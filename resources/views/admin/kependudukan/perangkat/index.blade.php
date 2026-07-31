@extends('layouts.admin')

@section('title', 'Data Perangkat Kelurahan')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <p class="text-muted mb-0">
                Daftar Perangkat Kelurahan 
            </p>
        </div>


        <a href="{{ route('admin.perangkat.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>
            Perangkat

        </a>

    </div>



    <div class="card shadow-sm">

        <div class="card-body">


            <div class="table-responsive">


                <table class="table table-hover align-middle">


                    <thead class="table-light">

                        <tr>

                            <th width="80">
                                Foto
                            </th>

                            <th>
                                Nama Lengkap
                            </th>

                            <th>
                                NIP
                            </th>

                            <th>
                                Jabatan
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="170" class="text-center">
    Aksi
</th>

                        </tr>

                    </thead>


                    <tbody>


                    @forelse($perangkats as $perangkat)


                        <tr>


                            <td>


                                @if($perangkat->foto)


                                    <img
                                        src="{{ asset('storage/'.$perangkat->foto) }}"
                                        class="rounded-circle"
                                        width="50"
                                        height="50"
                                        style="object-fit:cover;">


                                @else


                                    <img
                                        src="{{ asset('images/avatar-default.png') }}"
                                        class="rounded-circle"
                                        width="50"
                                        height="50"
                                        style="object-fit:cover;">


                                @endif


                            </td>



                            <td>

                                <strong>
                                    {{ $perangkat->nama_lengkap }}
                                </strong>


                            </td>



                            <td>

                                {{ $perangkat->nip ?? '-' }}

                            </td>



                            <td>

                                {{ $perangkat->jabatan->nama ?? '-' }}

                            </td>



                            <td>


                                @if($perangkat->aktif)


                                    <span class="badge bg-success">

                                        Aktif

                                    </span>


                                @else


                                    <span class="badge bg-secondary">

                                        Tidak Aktif

                                    </span>


                                @endif


                            </td>



<td class="text-center">

      <div class="action-buttons">

        {{-- Detail --}}
        <a href="{{ route('admin.perangkat.show',$perangkat) }}"
           class="btn btn-info btn-sm"
           title="Detail">

            <i class="bi bi-eye"></i>

        </a>

        {{-- Edit --}}
        <a href="{{ route('admin.perangkat.edit',$perangkat) }}"
           class="btn btn-warning btn-sm"
           title="Edit">

            <i class="bi bi-pencil"></i>

        </a>

        {{-- Hapus --}}
        <form
            action="{{ route('admin.perangkat.destroy',$perangkat) }}"
            method="POST"
            class="d-inline mb-0">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger btn-sm"
                title="Hapus"
                onclick="return confirm('Hapus data perangkat ini?')">

                <i class="bi bi-trash"></i>

            </button>

        </form>

    </div>

</td>

       </tr>
                @empty
                        <tr>

                            <td colspan="6"
                                class="text-center text-muted py-4">


                                Belum ada data perangkat.


                            </td>

                        </tr>


                    @endforelse


                    </tbody>


                </table>


            </div>



            <div class="mt-3">

                {{ $perangkats->links() }}

            </div>


        </div>

    </div>

</div>


@endsection