@extends('layouts.admin')

@section('title', 'Detail Pengumuman')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                Detail Pengumuman
            </h3>

            <p class="text-muted mb-0">
                Informasi lengkap pengumuman.
            </p>

        </div>

        <a href="{{ route('admin.website.pengumuman.index') }}"
           class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left me-2"></i>
            Kembali

        </a>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            @if($pengumuman->gambar)

                <div class="text-center mb-4">

                    <img
                        src="{{ asset('storage/'.$pengumuman->gambar) }}"
                        class="img-fluid rounded shadow-sm"
                        style="max-height:400px;"
                        alt="{{ $pengumuman->judul }}">

                </div>

            @endif

            <table class="table table-borderless">

                <tr>
                    <th width="180">Judul</th>
                    <td>{{ $pengumuman->judul }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>

                        @if($pengumuman->status == 'publish')

                            <span class="badge bg-success">
                                Publish
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                Draft
                            </span>

                        @endif

                    </td>
                </tr>

                <tr>
                    <th>Tanggal Publish</th>
                    <td>

                        {{ $pengumuman->tanggal_publish
                            ? $pengumuman->tanggal_publish->format('d F Y')
                            : '-' }}

                    </td>
                </tr>

                <tr>
                    <th>Dibuat</th>
                    <td>

                        {{ $pengumuman->created_at->format('d F Y H:i') }}

                    </td>
                </tr>

            </table>

            <hr>

            <h5 class="fw-bold mb-3">
                Isi Pengumuman
            </h5>

            <div class="border rounded p-3 bg-light">

                {!! nl2br(e($pengumuman->isi)) !!}

            </div>

            <div class="mt-4">

                <a href="{{ route('admin.website.pengumuman.edit', $pengumuman) }}"
                   class="btn btn-warning">

                    <i class="fa-solid fa-pen me-2"></i>

                    Edit

                </a>

                <a href="{{ route('admin.website.pengumuman.index') }}"
                   class="btn btn-light">

                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>

@endsection