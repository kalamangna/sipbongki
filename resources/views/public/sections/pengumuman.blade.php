<section id="pengumuman" class="py-20 bg-slate-50">
    <div class="container mx-auto px-4 max-w-7xl">

        {{-- JUDUL SECTION --}}
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
            <span class="inline-block px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-900 font-bold text-xs tracking-wider uppercase">
                Pengumuman Resmi
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Pengumuman Penting Kelurahan
            </h2>
            <p class="text-slate-600 text-sm sm:text-base">
                Dapatkan informasi resmi dan pemberitahuan penting dari Kelurahan Bongki.
            </p>
        </div>

        {{-- DAFTAR PENGUMUMAN --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($pengumumen ?? [] as $item)
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 bg-amber-50 text-amber-700 text-xs font-bold rounded-full border border-amber-200/50">
                                Pengumuman
                            </span>
                            <span class="text-xs text-slate-400 font-medium">
                                <i class="fa-regular fa-clock mr-1"></i>
                                {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d M Y') }}
                            </span>
                        </div>

                        <h3 class="font-bold text-lg text-slate-900 group-hover:text-amber-600 transition line-clamp-2 leading-snug">
                            <a href="{{ route('pengumuman.detail', $item->slug) }}">
                                {{ $item->judul }}
                            </a>
                        </h3>

                        <p class="text-slate-500 text-xs leading-relaxed line-clamp-3">
                            {{ Str::limit(strip_tags($item->isi), 120) }}
                        </p>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[11px] font-semibold text-slate-400">Penting</span>

                        <a href="{{ route('pengumuman.detail', $item->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 group-hover:text-amber-700">
                            <span>Detail Pengumuman</span>
                            <i class="fa-solid fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-3xl border border-slate-100 shadow-sm space-y-3">
                    <i class="fa-solid fa-bullhorn text-4xl text-slate-300"></i>
                    <p class="text-slate-500 text-sm font-medium">Belum ada pengumuman terbaru saat ini.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>