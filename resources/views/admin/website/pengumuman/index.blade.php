@extends('layouts.admin')


@section('title', 'Manajemen Pengumuman')


@section('content')


<div class="container-fluid">



    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

          

            <p class="text-muted mb-0">
                Kelola pengumuman publik SiPBongki.
            </p>


        </div>




        <a href="{{ route('admin.website.pengumuman.create') }}"
           class="btn btn-primary">


            <i class="fa-solid fa-circle-plus me-2"></i>

            Tambah Pengumuman


        </a>


    </div>







    

    <div class="card border-0 shadow-sm">


        <div class="card-body">



            <div class="table-responsive">


                <table class="table table-hover align-middle">



                    <thead>


                        <tr>


                            <th width="70">
                                No
                            </th>


                            <th width="120">
                                Gambar
                            </th>


                            <th>
                                Judul
                            </th>


                            <th>
                                Status
                            </th>


                            <th>
                                Tanggal
                            </th>


                            <th width="190">
                                Aksi
                            </th>


                        </tr>


                    </thead>






                    <tbody>



                    @forelse($pengumumen as $index => $pengumuman)



                        <tr>



                            <td>

                                {{ $pengumumen->firstItem() + $index }}

                            </td>







                            <td>


                                @if($pengumuman->gambar)


                                    <img
                                        src="{{ asset('storage/'.$pengumuman->gambar) }}"
                                        width="90"
                                        height="60"
                                        class="rounded object-fit-cover"
                                        alt="{{ $pengumuman->judul }}"
                                    >


                                @else


                                    <span class="badge bg-secondary">

                                        Tidak ada

                                    </span>


                                @endif


                            </td>








                            <td>


                                <strong>

                                    {{ $pengumuman->judul }}

                                </strong>



                                <br>


                                <small class="text-muted">

                                    {{ Str::limit(strip_tags($pengumuman->isi),70) }}

                                </small>


                            </td>









                            <td>


                                @if($pengumuman->status === 'publish')


                                    <span class="badge bg-success">

                                        <i class="fa-solid fa-circle-check me-1"></i>

                                        Publish

                                    </span>


                                @else


                                    <span class="badge bg-secondary">

                                        <i class="fa-solid fa-pen me-1"></i>

                                        Draft

                                    </span>


                                @endif


                            </td>









                            <td>


                                {{ 
                                    $pengumuman->tanggal_publish
                                    ? $pengumuman->tanggal_publish->format('d M Y')
                                    : '-'
                                }}


                            </td>









 <td class="text-center">

    <div class="action-buttons">

        {{-- Detail --}}
        <a href="{{ route('admin.website.pengumuman.show',$pengumuman) }}"
           class="btn btn-info btn-sm"
           title="Lihat Detail">

            <i class="fa-solid fa-eye"></i>

        </a>

        {{-- Edit --}}
        <a href="{{ route('admin.website.pengumuman.edit',$pengumuman) }}"
           class="btn btn-warning btn-sm"
           title="Edit Pengumuman">

            <i class="fa-solid fa-pen"></i>

        </a>

        {{-- Hapus --}}
        <form action="{{ route('admin.website.pengumuman.destroy',$pengumuman) }}"
              method="POST"
              class="d-inline m-0">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger btn-sm"
                title="Hapus Pengumuman"
                onclick="return confirm('Yakin hapus pengumuman ini?')">

                <i class="fa-solid fa-trash"></i>

            </button>

        </form>

    </div>

</td>                          





                        </tr>




                    @empty



                        <tr>


                            <td colspan="6"
                                class="text-center text-muted py-4">


                                <i class="fa-solid fa-bullhorn fs-3 d-block mb-2"></i>

                                Belum ada pengumuman.



                            </td>


                        </tr>



                    @endforelse




                    </tbody>



                </table>


            </div>






            <div class="mt-3">

                {{ $pengumumen->links() }}

            </div>





        </div>


    </div>




</div>



@endsection