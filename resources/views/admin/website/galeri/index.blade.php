@extends('layouts.admin')


@section('title', 'Manajemen Galeri')


@section('content')


<div class="container-fluid">


    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">


        <div>

           

            <p class="text-slate-500 mb-0">
                Kelola dokumentasi kegiatan Kelurahan Bongki.
            </p>

        </div>



        <a href="{{ route('admin.website.galeri.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">

            <i class="bi bi-plus-circle mr-2"></i>

            Tambah Galeri

        </a>


    </div>








    {{-- CARD --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">


        <div class="p-6">



            <div class="overflow-x-auto w-full">


                <table class="w-full text-left border-collapse text-sm table-hover align-middle">


                    <thead>

                        <tr>

                            <th width="70">
                                No
                            </th>


                            <th width="120">
                                Foto
                            </th>


                            <th>
                                Judul
                            </th>


                            <th>
                                Status
                            </th>


                            <th>
                                Dibuat
                            </th>


                            <th width="150">
                                Aksi
                            </th>

                        </tr>


                    </thead>




                    <tbody>


                    @forelse($galeris as $index => $galeri)


                        <tr>


                            <td>

                                {{ $galeris->firstItem() + $index }}

                            </td>





                            <td>


                                <img 
                                    src="{{ asset('storage/'.$galeri->gambar) }}"
                                    width="90"
                                    height="60"
                                    class="rounded object-fit-cover"
                                    alt="{{ $galeri->judul }}"
                                >


                            </td>






                            <td>


                                <strong>

                                    {{ $galeri->judul }}

                                </strong>


                                @if($galeri->deskripsi)

                                    <br>

                                    <small class="text-slate-500">

                                        {{ Str::limit($galeri->deskripsi,60) }}

                                    </small>

                                @endif


                            </td>






                            <td>


                                @if($galeri->status == 'aktif')


                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">

                                        Aktif

                                    </span>


                                @else


                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

                                        Nonaktif

                                    </span>


                                @endif


                            </td>







                            <td>

                                {{ $galeri->created_at->format('d M Y') }}

                            </td>







<td class="text-center">

    <div class="action-buttons">

        {{-- Detail --}}
        <a href="{{ route('admin.website.galeri.show',$galeri->id) }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
           title="Detail">

            <i class="bi bi-eye"></i>

        </a>

        {{-- Hapus --}}
        <form action="{{ route('admin.website.galeri.destroy',$galeri->id) }}"
              method="POST"
              class="d-inline m-0">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs"
                title="Hapus"
                onclick="return confirm('Hapus galeri ini?')">

                <i class="bi bi-trash"></i>

            </button>

        </form>

    </div>

</td>

                        </tr>


                    @empty


                        <tr>

                            <td colspan="6"
                                class="text-center text-slate-500 py-4">


                                Belum ada dokumentasi.


                            </td>

                        </tr>


                    @endforelse



                    </tbody>


                </table>


            </div>





            {{ $galeris->links() }}




        </div>


    </div>


</div>


@endsection