{{-- ═══════════════════════════════════════════════
    SERVICES SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="layanan" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary mb-4">Pelayanan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Layanan Administrasi</h2>
        </div>

        {{-- Cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($jenisSurats ?? [] as $jenisSurat)

                <div class="group flex flex-col bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">

                    <div class="w-14 h-14 rounded-2xl bg-primary-light flex items-center justify-center mb-5 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <i class="{{ $jenisSurat->icon ?? 'fa-solid fa-file-lines' }} text-primary group-hover:text-white transition-colors text-2xl"></i>
                    </div>

                    <h3 class="text-base font-bold text-slate-800 mb-2 group-hover:text-primary transition-colors">
                        {{ $jenisSurat->nama }}
                    </h3>

                    <p class="text-sm text-slate-500 leading-relaxed flex-1">
                        {{ $jenisSurat->deskripsi ?: 'Pelayanan administrasi Kelurahan Bongki.' }}
                    </p>

                    <div class="mt-5 pt-4 border-t border-slate-100">
                        <a href="{{ route('permohonan.create', ['jenis' => $jenisSurat->id]) }}"
                           class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl bg-primary hover:bg-primary-dark text-white text-sm font-semibold transition-all duration-200 active:scale-95 shadow-sm shadow-primary/20 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            Ajukan Permohonan
                        </a>
                    </div>

                </div>

            @empty

                <div class="sm:col-span-2 lg:col-span-3 py-16 text-center text-slate-400">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-3 text-slate-400 text-2xl">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <h4 class="text-base font-semibold text-slate-700 mb-1">Belum Ada Layanan</h4>
                    <p class="text-sm text-slate-500 max-w-sm mx-auto">Jenis pelayanan akan ditampilkan setelah dipublikasikan melalui Dashboard Admin.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>