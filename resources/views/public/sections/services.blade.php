<section id="layanan" class="py-20 bg-slate-50">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- JUDUL SECTION --}}
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
            <span class="inline-block px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs tracking-wider uppercase">
                Layanan Administrasi
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Layanan Surat Keterangan Online
            </h2>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                Pilih jenis surat yang Anda butuhkan dan ajukan permohonan secara mandiri dari mana saja tanpa antre.
            </p>
        </div>

        {{-- DAFTAR LAYANAN SURAT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($jenisSurats ?? $jenisSurat ?? [] as $surat)
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl group-hover:bg-emerald-600 group-hover:text-white transition duration-300">
                            <i class="{{ $surat->icon ?? 'fa-solid fa-file-lines' }}"></i>
                        </div>

                        <div class="space-y-2">
                            <h4 class="font-bold text-lg text-slate-900 group-hover:text-emerald-600 transition">
                                {{ $surat->nama_surat }}
                            </h4>
                            <p class="text-slate-500 text-xs leading-relaxed line-clamp-3">
                                {{ $surat->persyaratan ?? 'Persyaratan pengajuan surat keterangan ini dapat dipersiapkan secara online melalui formulir permohonan.' }}
                            </p>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-400">
                            Kode: {{ $surat->kode_surat ?? '-' }}
                        </span>

                        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 group-hover:text-emerald-700">
                            <span>Ajukan Surat</span>
                            <i class="fa-solid fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-3xl border border-slate-100 shadow-sm space-y-3">
                    <i class="fa-solid fa-folder-open text-4xl text-slate-300"></i>
                    <p class="text-slate-500 text-sm font-medium">Belum ada jenis layanan surat yang tersedia.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>