@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 mb-1">Pengaturan Website</h3>
        <p class="text-sm text-slate-500">Kelola identitas dan informasi utama website</p>
    </div>
    <a href="{{ route('admin.website.pengaturan.edit') }}"
        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all active:scale-95 cursor-pointer focus:outline-none">
        <i class="fa-solid fa-pen-to-square"></i> Edit Pengaturan
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- LOGO --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-full">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Logo Website</h5>
            </div>
            <div class="p-6 flex items-center justify-center min-h-40">
                @if($setting && $setting->logo)
                    <img src="{{ asset('storage/'.$setting->logo) }}" alt="Logo Website"
                        class="max-w-full max-h-48 object-contain rounded-lg">
                @else
                    <div class="text-center text-slate-400">
                        <i class="fa-solid fa-image text-4xl mb-3"></i>
                        <p class="text-sm">Logo belum tersedia</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- INFORMASI WEBSITE --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-full">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Informasi Website</h5>
            </div>
            <div class="divide-y divide-slate-100">
                @foreach([
                    ['label' => 'Nama Website',    'value' => $setting->nama_website ?? '-'],
                    ['label' => 'Nama Kelurahan',  'value' => $setting->nama_kelurahan ?? '-'],
                    ['label' => 'Telepon',         'value' => $setting->telepon ?? '-'],
                    ['label' => 'WhatsApp',        'value' => $setting->whatsapp ?? '-'],
                    ['label' => 'Email',           'value' => $setting->email ?? '-'],
                    ['label' => 'Jam Pelayanan',   'value' => $setting->jam_pelayanan ?? '-'],
                    ['label' => 'Alamat',          'value' => $setting->alamat ?? '-'],
                ] as $row)
                <div class="flex px-6 py-3 text-sm">
                    <span class="w-40 shrink-0 font-medium text-slate-500">{{ $row['label'] }}</span>
                    <span class="text-slate-800">{{ $row['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- SOSIAL MEDIA --}}
    <div class="lg:col-span-3">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Sosial Media</h5>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <i class="fa-brands fa-facebook text-base"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 mb-0.5">Facebook</p>
                        <p class="text-sm text-slate-800 break-all">{{ $setting->facebook ?? '-' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center shrink-0">
                        <i class="fa-brands fa-instagram text-base"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 mb-0.5">Instagram</p>
                        <p class="text-sm text-slate-800 break-all">{{ $setting->instagram ?? '-' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                        <i class="fa-brands fa-youtube text-base"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500 mb-0.5">YouTube</p>
                        <p class="text-sm text-slate-800 break-all">{{ $setting->youtube ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DESKRIPSI --}}
    <div class="lg:col-span-3">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h5 class="text-sm font-bold text-slate-800">Deskripsi Website</h5>
            </div>
            <div class="p-6">
                <p class="text-sm text-slate-600 leading-relaxed">{{ $setting->deskripsi ?? 'Belum ada deskripsi.' }}</p>
            </div>
        </div>
    </div>

</div>

@endsection