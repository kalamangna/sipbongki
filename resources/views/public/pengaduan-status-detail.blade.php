@extends('layouts.public')

@section('title', 'Status Pengaduan')

@section('content')

<section class="min-h-screen py-24 bg-slate-50 pt-32 flex items-center justify-center">
    <div class="max-w-3xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-3xl shadow-md overflow-hidden border border-slate-200">
            <div class="p-5 sm:p-8 md:p-12">
                
                <div class="text-center mb-8 border-b border-slate-200 pb-8">
                    <div class="w-16 h-16 mx-auto bg-primary-light rounded-full flex items-center justify-center mb-4 text-primary text-xl">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-2">Status Pengaduan</h2>
                    <p class="text-slate-500">
                        Informasi status laporan Anda dengan kode <strong class="text-slate-700 tracking-wide">{{ $pengaduan->kode }}</strong>
                    </p>
                </div>

                <div class="space-y-4">
                    
                    <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                        <span class="sm:w-1/3 text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Kode Pengaduan</span>
                        <span class="sm:w-2/3 text-slate-800 font-medium">{{ $pengaduan->kode }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                        <span class="sm:w-1/3 text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Nama Pelapor</span>
                        <span class="sm:w-2/3 text-slate-800">{{ $pengaduan->nama }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                        <span class="sm:w-1/3 text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">NIK Pelapor</span>
                        <span class="sm:w-2/3 text-slate-800 font-mono">@maskNik($pengaduan->nik_pelapor)</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                        <span class="sm:w-1/3 text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Status</span>
                        <span class="sm:w-2/3">
                            @if($pengaduan->status == 'Baru')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">Baru</span>
                            @elseif($pengaduan->status == 'Diproses')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">Diproses</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Selesai</span>
                            @endif
                        </span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                        <span class="sm:w-1/3 text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Lokasi</span>
                        <span class="sm:w-2/3 text-slate-800">{{ $pengaduan->lokasi }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                        <span class="sm:w-1/3 text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Kategori</span>
                        <span class="sm:w-2/3 text-slate-800">{{ $pengaduan->kategori }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-start py-3 border-b border-slate-50">
                        <span class="sm:w-1/3 text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0 mt-1">Uraian</span>
                        <span class="sm:w-2/3 text-slate-800 leading-relaxed">{{ $pengaduan->uraian }}</span>
                    </div>

                    @if(!empty($pengaduan->catatan))
                        <div class="flex flex-col sm:flex-row sm:items-start py-3 bg-blue-50/50 rounded-xl p-4 mt-4">
                            <span class="sm:w-1/3 text-sm font-semibold text-blue-700 uppercase tracking-wider mb-1 sm:mb-0 mt-1">Catatan Petugas</span>
                            <span class="sm:w-2/3 text-blue-900 leading-relaxed italic border-l-2 border-blue-200 pl-4">{{ $pengaduan->catatan }}</span>
                        </div>
                    @endif

                </div>

                <div class="text-center mt-10 pt-6 border-t border-slate-100">
                    <a href="{{ route('pengaduan') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-primary text-primary font-semibold hover:bg-primary hover:text-white transition-all duration-200 hover:-translate-y-0.5 active:scale-95 shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 w-full sm:w-auto">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali ke Form Pengaduan
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
