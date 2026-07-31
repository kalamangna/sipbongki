@extends('layouts.admin')

@section('title', 'Tambah Perangkat Kelurahan')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        
      
    </div>

    <form
    action="{{ route('admin.perangkat.store') }}"
    method="POST"
    enctype="multipart/form-data">

    @include('admin.kependudukan.perangkat.form')

</form>

</div>

@endsection