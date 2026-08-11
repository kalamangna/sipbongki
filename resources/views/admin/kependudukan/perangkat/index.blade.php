@extends('layouts.admin')

@section('title', 'Data Perangkat Kelurahan')

@section('content')

<div class="container-fluid">

    <div class="flex justify-between items-center mb-6">

        <div>
            <p class="text-slate-500 mb-0">
                Daftar Perangkat Kelurahan 
            </p>
        </div>


        <a href="{{ route('admin.perangkat.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

            <i class="bi bi-plus-circle"></i>
            Perangkat

        </a>

    </div>



    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">

        <div class="p-6">


            <div class="overflow-x-auto w-full">


                <table class="w-full text-left border-collapse text-sm table-hover align-middle">


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
                                {{ $perangkat->nama_lengkap }}
                            </td>



                            <td>

                                {{ $perangkat->nip ?? '-' }}

                            </td>



                            <td>

                                {{ $perangkat->jabatan->nama ?? '-' }}

                            </td>



                            <td>


                                @if($perangkat->aktif)


                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

                                        Aktif

                                    </span>


                                @else


                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

                                        Tidak Aktif

                                    </span>


                                @endif


                            </td>



<td class="text-center">

      <div class="action-buttons">

        {{-- Detail --}}
        <a href="{{ route('admin.perangkat.show',$perangkat) }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
           title="Detail">

            <i class="bi bi-eye"></i>

        </a>

    </div>

</td>

       </tr>
                @empty
                        <tr>

                            <td colspan="6"
                                class="text-center text-slate-500 py-4">


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