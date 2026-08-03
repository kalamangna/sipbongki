@extends('layouts.admin')


@section('title', 'Manajemen Berita')


@section('content')


<div class="container-fluid">



    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            

            <p class="text-muted mb-0">
                Kelola informasi dan berita publik SiPBongki.
            </p>


        </div>




        <a href="{{ route('admin.website.berita.create') }}"
           class="btn btn-primary">


            <i class="fa-solid fa-circle-plus me-2"></i>

            Tambah Berita


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



                    @forelse($beritas as $index => $berita)



                        <tr>



                            <td>

                                {{ $beritas->firstItem() + $index }}

                            </td>







                            <td>


                                @if($berita->gambar)


                                    <img
                                        src="{{ asset('storage/'.$berita->gambar) }}"
                                        width="90"
                                        height="60"
                                        class="rounded object-fit-cover"
                                        alt="{{ $berita->judul }}"
                                    >


                                @else


                                    <span class="badge bg-secondary">

                                        Tidak ada

                                    </span>


                                @endif


                            </td>








                            <td>


                                <strong>

                                    {{ $berita->judul }}

                                </strong>



                                <br>


                                <small class="text-muted">

                                    {{ Str::limit(strip_tags($berita->isi),70) }}

                                </small>


                            </td>









                            <td>


                                @if($berita->status === 'publish')


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
                                    $berita->tanggal_publish
                                    ? $berita->tanggal_publish->format('d M Y')
                                    : '-'
                                }}


                            </td>









 <td class="text-center">

    <div class="action-buttons">

        {{-- Detail --}}
        <a href="{{ route('admin.website.berita.show',$berita) }}"
           class="btn btn-info btn-sm"
           title="Lihat Detail">

            <i class="fa-solid fa-eye"></i>

        </a>

        {{-- Edit --}}
        <a href="{{ route('admin.website.berita.edit',$berita) }}"
           class="btn btn-warning btn-sm"
           title="Edit Berita">

            <i class="fa-solid fa-pen"></i>

        </a>

        {{-- Hapus --}}
        <form action="{{ route('admin.website.berita.destroy',$berita) }}"
              method="POST"
              class="d-inline m-0">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger btn-sm"
                title="Hapus Berita"
                onclick="return confirm('Yakin hapus berita ini?')">

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


                                <i class="fa-solid fa-newspaper fs-3 d-block mb-2"></i>

                                Belum ada berita.



                            </td>


                        </tr>



                    @endforelse




                    </tbody>



                </table>


            </div>






            <div class="mt-3">

                {{ $beritas->links() }}

            </div>





        </div>


    </div>




</div>



@endsection