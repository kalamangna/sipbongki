{{-- ═══════════════════════════════════════════════
    GALLERY SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="galeri" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary mb-4">Galeri</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Galeri Kegiatan</h2>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 gap-4">

            @forelse($galeris as $galeri)

                <div class="group relative overflow-hidden rounded-2xl aspect-square bg-slate-100 cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300">

                    <img src="{{ asset('storage/'.$galeri->gambar) }}"
                         alt="{{ $galeri->judul }}"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                        <div>
                            <h5 class="text-sm font-bold text-white line-clamp-1">{{ $galeri->judul }}</h5>
                        </div>
                    </div>

                </div>

            @empty

                <div class="col-span-2 sm:col-span-3 py-16 text-center text-slate-400">
                    <i class="fa-solid fa-image"></i>
                    <h5 class="text-lg font-semibold text-slate-600 mb-1">Galeri Belum Tersedia</h5>
                    <p class="text-sm">Dokumentasi kegiatan akan ditampilkan setelah dipublikasikan.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>