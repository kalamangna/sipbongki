@extends('layouts.operator')

@section('title','Data Penduduk')

@section('subtitle','Kelola data penduduk Kelurahan Bongki')

@section('content')


<div class="dashboard-container">



<div class="card dashboard-card">


    <div class="card-header d-flex justify-content-between align-items-center">


        <div>

            <h5 class="fw-bold mb-1">

                Data Penduduk

            </h5>


            <small class="text-muted">

                Data penduduk yang digunakan dalam pelayanan masyarakat

            </small>

        </div>



        <a href="{{ route('operator.penduduk.create') }}"
           class="btn btn-primary">


            <i class="fa-solid fa-user-plus me-2"></i>


            Tambah Penduduk


        </a>


    </div>







    <div class="card-body">



        {{-- Search --}}

        <form method="GET"
              action="{{ route('operator.penduduk.index') }}"
              class="row g-3 mb-4">



            <div class="col-md-6">


                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="Cari NIK atau Nama Penduduk">


            </div>



            <div class="col-md-3">


                <button class="btn btn-primary">

                    <i class="fa-solid fa-search me-2"></i>

                    Cari

                </button>


            </div>



        </form>








        <div class="table-responsive">


            <table class="table table-hover align-middle">


                <thead>


                    <tr>


                        <th>

                            No

                        </th>


                        <th>

                            NIK

                        </th>



                        <th>

                            Nama

                        </th>



                        <th>

                            JK

                        </th>



                        <th>

                            Lingkungan

                        </th>



                        <th width="150">

                            Aksi

                        </th>


                    </tr>


                </thead>






                <tbody>



                @forelse($penduduk as $item)



                    <tr>



                        <td>

                            {{ $loop->iteration }}

                        </td>



                        <td>

                            {{ $item->nik }}

                        </td>




                        <td>


                            <strong>

                                {{ $item->nama_lengkap }}

                            </strong>


                        </td>





                        <td>

                            {{ $item->jenis_kelamin }}

                        </td>





                        <td>

                            {{ optional($item->lingkungan)->nama }}

                        </td>







                        <td>



                            <a href="{{ route('operator.penduduk.show',$item->id) }}"
                               class="btn btn-sm btn-info text-white">


                                <i class="fa-solid fa-eye"></i>


                            </a>





                            <a href="{{ route('operator.penduduk.edit',$item->id) }}"
                               class="btn btn-sm btn-warning">


                                <i class="fa-solid fa-pen"></i>


                            </a>



                        </td>




                    </tr>




                @empty



                    <tr>


                        <td colspan="6"
                            class="text-center py-4">


                            Belum ada data penduduk.



                        </td>



                    </tr>



                @endforelse




                </tbody>




            </table>



        </div>





        <div class="mt-3">


            {{ $penduduk->links() }}


        </div>



    </div>



</div>



</div>


@endsection