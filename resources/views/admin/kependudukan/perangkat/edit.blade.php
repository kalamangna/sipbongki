@extends('layouts.admin')

@section('title', 'Edit Perangkat Kelurahan')

@section('content')

<div class="container-fluid">

    <div class="mb-6">

        
        <p class="text-slate-500">
            Update Data Pejabat Kelurahan
        </p>

    </div>

    <form
    action="{{ route('admin.perangkat.update', $perangkat) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    @include('admin.kependudukan.perangkat.form')

</form>

</div>

@endsection