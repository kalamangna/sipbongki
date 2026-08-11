@extends('layouts.admin')

@section('title', 'Detail Pengumuman')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">

        <div>

            <h3 class="font-bold mb-1">
                Detail Pengumuman
            </h3>

            <p class="text-slate-500 mb-0">
                Informasi lengkap pengumuman Kelurahan Bongki.
            </p>

        </div>

        <div class="flex gap-2">

            <a href="{{ route('admin.website.pengumuman.index') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all btn-secondary">

                <i class="bi bi-arrow-left"></i>
                Kembali

            </a>

            <a href="{{ route('admin.website.pengumuman.edit', $pengumuman) }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm">

                <i class="bi bi-pencil-square"></i>
                Edit

            </a>

        </div>

    </div>

    <div class="flex flex-wrap -mx-3">

        <div class="w-full lg:w-2/3 px-3">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

                <div class="p-6">

                    <h2 class="font-bold mb-4" style="text-align: justify; text-justify: inter-word;">
                        {{ $pengumuman->judul }}
                    </h2>

                    @if($pengumuman->gambar)

                        <div class="mb-6">

                            <img
                                src="{{ asset('storage/'.$pengumuman->gambar) }}"
                                class="img-fluid rounded shadow-sm"
                                style="width:100%; max-width:100%; max-height:420px; object-fit:cover;"
                                alt="{{ $pengumuman->judul }}">

                        </div>

                    @endif

                    <div class="flex gap-3 text-slate-500 mb-6">

                        <span>
                            <i class="bi bi-calendar-event"></i>
                            {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d M Y') : '-' }}
                        </span>

                        <span>
                            <i class="bi bi-circle-fill small"></i>
                            {{ ucfirst($pengumuman->status) }}
                        </span>

                    </div>

                    <div class="article-content" style="text-align: justify; text-justify: inter-word;">
                        {!! nl2br(e($pengumuman->isi)) !!}
                    </div>

                </div>

            </div>

        </div>

        <div class="w-full lg:w-1/3 px-3">

            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

                <div class="px-6 py-4 border-b border-slate-200 bg-white">

                    <h5 class="font-bold mb-0">
                        Informasi Pengumuman
                    </h5>

                </div>

                <div class="p-6">

                    <div class="mb-4">

                        <small class="text-slate-500 d-block">
                            Judul
                        </small>

                        <div style="text-align: justify; text-justify: inter-word;">
                            {{ $pengumuman->judul }}
                        </div>

                    </div>

                    <div class="mb-4">

                        <small class="text-slate-500 d-block">
                            Status
                        </small>

                        @if($pengumuman->status == 'publish')

                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                Publish
                            </span>

                        @else

                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                Draft
                            </span>

                        @endif

                    </div>

                    <div class="mb-4">

                        <small class="text-slate-500 d-block">
                            Tanggal Publish
                        </small>

                        <div style="text-align: justify; text-justify: inter-word;">
                            {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d F Y') : '-' }}
                        </div>

                    </div>

                    <div>

                        <small class="text-slate-500 d-block">
                            Dibuat
                        </small>

                        <div style="text-align: justify; text-justify: inter-word;">
                            {{ $pengumuman->created_at->format('d F Y H:i') }} WITA
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection