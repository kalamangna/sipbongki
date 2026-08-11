@extends('layouts.admin')

@section('title', 'Permohonan Surat')

@section('content')
<div class="container-fluid">

    <div class="flex justify-between items-center mb-6">

        <div>
            
            
            <small class="text-slate-500">

            Daftar pelayanan surat masyarakat

            </small>

            </div>

        <a
            href="{{ route('admin.permohonan-surat.create') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

            <i class="bi bi-plus-circle"></i>
            Permohonan

        </a>

    </div>


    
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

        <div class="px-6 py-4 border-b border-slate-200 bg-white">

            <form method="GET">

                <div class="flex flex-wrap -mx-3 g-2">

                    <div class="col-md-8">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Cari Nomor / Nama Pemohon...">

                    </div>


                    <div class="col-auto">

                        <button class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

                            <i class="bi bi-search"></i>
                            Cari

                        </button>

                    </div>


                    @if(request('search'))

                        <div class="col-auto">

                            <a
                                href="{{ route('admin.permohonan-surat.index') }}"
                                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">

                                Reset

                            </a>

                        </div>

                    @endif

                </div>

            </form>

        </div>



        <div class="p-6 p-0">

            <table class="w-full text-left border-collapse text-sm table-hover align-middle mb-0 text-center">

                <thead class="table-light">

                    <tr>

                        <th width="70" class="text-center">
                            No
                        </th>

                        <th class="text-center">
                            No. Permohonan
                        </th>

                        <th class="text-center">
                            Tanggal
                        </th>

                        <th class="text-center">
                            Pemohon
                        </th>

                        <th class="text-center">
                            Jenis Surat
                        </th>

                        <th class="text-center">
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

                        <td class="text-center">
                            {{ $permohonans->firstItem() + $loop->index }}
                        </td>


                        <td class="text-center">
                            {{ $permohonan->nomor_permohonan }}
                        </td>


                        <td class="text-center">
                            {{ $permohonan->tanggal_permohonan->format('d-m-Y') }}
                        </td>


                        <td class="text-center">
                            {{ optional($permohonan->penduduk)->nama_lengkap ?? data_get($permohonan->data_surat, 'nama_lengkap') ?? '-' }}
                        </td>


                        <td class="text-center">
                            {{ $permohonan->jenisSurat->nama }}
                        </td>


                        <td class="text-center">

                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ $permohonan->status_badge_class }}">

                                {{ $permohonan->status }}

                            </span>

                        </td>

<td class="text-center">

   <div class="action-buttons">

    {{-- Detail --}}
    <a href="{{ route('admin.permohonan-surat.show', $permohonan) }}"
       class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
       title="Detail">
        <i class="bi bi-eye"></i>
    </a>

</div>

</td>
      </tr>


                @empty

                    <tr>

                        <td colspan="7" class="text-center py-8">

                            <i class="bi bi-envelope-paper fs-1 d-block mb-4"></i>

                            <span class="text-slate-500">

                                Belum ada permohonan surat.

                            </span>

                        </td>

                    </tr>

                @endforelse


                </tbody>


            </table>


        </div>



        @if($permohonans->hasPages())

            <div class="px-6 py-4 border-t border-slate-200 bg-white">

                {{ $permohonans->links() }}

            </div>

        @endif


    </div>

</div>
@endsection