@extends('layouts.admin')

@section('title', 'Hak Akses')

@section('content')
<div class="w-full">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-1">Daftar Hak Akses</h3>
            <p class="text-slate-500 dark:text-slate-400 mb-0 text-sm">Pengaturan peran pengguna dan hak akses sistem.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden dark:bg-slate-900 dark:border-slate-800">
        <div class="p-6">
            <p class="text-slate-600 dark:text-slate-300 text-sm">Halaman ini menampilkan ringkasan peran yang tersedia dalam sistem untuk akses administrasi.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div class="border border-slate-100 dark:border-slate-800 rounded-xl overflow-hidden bg-slate-50/50 dark:bg-slate-800/50 p-4">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100 text-base mb-2">Administrator</h3>
                    <p class="mb-0 text-slate-500 dark:text-slate-400 text-sm">Memiliki akses penuh ke seluruh modul admin.</p>
                </div>
                
                <div class="border border-slate-100 dark:border-slate-800 rounded-xl overflow-hidden bg-slate-50/50 dark:bg-slate-800/50 p-4">
                    <h3 class="font-bold text-slate-800 dark:text-slate-100 text-base mb-2">Operator</h3>
                    <p class="mb-0 text-slate-500 dark:text-slate-400 text-sm">Dapat mengelola data kependudukan, persuratan, dan laporan.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
