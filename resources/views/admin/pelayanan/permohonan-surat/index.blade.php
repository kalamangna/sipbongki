@extends('layouts.admin')

@section('title', 'Permohonan Surat')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h5 class="fw-bold mb-1">
                Permohonan Surat
            </h5>

            </div>

        <a
            href="{{ route('admin.permohonan-surat.create') }}"
            class="btn btn-primary">

            <i class="fa-solid fa-circle-plus"></i>
            Tambah

        </a>

    </div>


    
    <div class="card shadow-sm">

        <div class="card-header bg-white">

            <form method="GET">

                <div class="row g-2">

                    <div class="col-md-8">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Cari Nomor / Nama Pemohon...">

                    </div>


                    <div class="col-auto">

                        <button class="btn btn-primary">

                            <i class="fa-solid fa-magnifying-glass"></i>
                            Cari

                        </button>

                    </div>


                    @if(request('search'))

                        <div class="col-auto">

                            <a
                                href="{{ route('admin.permohonan-surat.index') }}"
                                class="btn btn-secondary">

                                Reset

                            </a>

                        </div>

                    @endif

                </div>

            </form>

        </div>



        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="70">
                            No
                        </th>

                        <th>
                            Nomor
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th>
                            Pemohon
                        </th>

                        <th>
                            Jenis Surat
                        </th>

                        <th>
                            Status
                        </th>

                        <th width="230" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($permohonans as $permohonan)

                    <tr>

                        <td>
                            {{ $permohonans->firstItem() + $loop->index }}
                        </td>


                        <td>
                            {{ $permohonan->nomor_permohonan }}
                        </td>


                        <td>
                            {{ $permohonan->tanggal_permohonan->format('d-m-Y') }}
                        </td>


                        <td>
                            {{ $permohonan->penduduk->nama_lengkap }}
                        </td>


                        <td>
                            {{ $permohonan->jenisSurat->nama }}
                        </td>


                        <td>

                            <span class="badge bg-{{ $permohonan->status_badge_class }}">

                                {{ $permohonan->status }}

                            </span>

                        </td>

<td class="text-center">

   <div class="action-buttons">

    {{-- Detail --}}
    <a href="{{ route('admin.permohonan-surat.show', $permohonan) }}"
       class="btn btn-info btn-sm"
       title="Detail">
        <i class="fa-solid fa-eye"></i>
    </a>

    {{-- Hapus --}}
    <form action="{{ route('admin.permohonan-surat.destroy', $permohonan) }}"
          method="POST"
          onsubmit="return confirm('Hapus data ini?')"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm"
                title="Hapus">
            <i class="fa-solid fa-trash"></i>
        </button>

    </form>

</div>

</td>
      </tr>


                @empty

                    <tr>

                        <td colspan="7" class="text-center py-5">

                            <i class="fa-solid fa-envelope-open-text fs-1 d-block mb-3"></i>

                            <span class="text-muted">

                                Belum ada permohonan surat.

                            </span>

                        </td>

                    </tr>

                @endforelse


                </tbody>


            </table>


        </div>



        @if($permohonans->hasPages())

            <div class="card-footer bg-white">

                {{ $permohonans->links() }}

            </div>

        @endif


    </div>

</div>
@endsection