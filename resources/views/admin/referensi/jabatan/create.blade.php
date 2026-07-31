@extends('layouts.admin')

@section('title', 'Tambah Jabatan')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow-sm">

                <div class="card-header">

                    <h5 class="mb-0">

                        Tambah Jabatan

                    </h5>

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('admin.jabatan.store') }}"
                        method="POST">

                        @csrf

                        @include('admin.referensi.jabatan.form')

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection