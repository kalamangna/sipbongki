{{-- ═══════════════════════════════════════════════
    GALLERY SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="galeri" 
    class="py-24 bg-white border-b border-slate-100"
    x-data="{ 
        modalOpen: false, 
        currentImage: '', 
        currentTitle: '' 
    }"
    @keydown.escape.window="modalOpen = false">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary mb-4">Galeri</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 tracking-tight">Dokumentasi Kegiatan</h2>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($galeris as $galeri)

                <div class="group relative overflow-hidden rounded-2xl aspect-[4/3] bg-slate-100 border border-slate-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                     tabindex="0"
                     role="button"
                     aria-label="Lihat gambar: {{ $galeri->judul }}"
                     @click="modalOpen = true; currentImage = '{{ asset('storage/'.$galeri->gambar) }}'; currentTitle = '{{ addslashes($galeri->judul) }}'"
                     @keydown.enter="modalOpen = true; currentImage = '{{ asset('storage/'.$galeri->gambar) }}'; currentTitle = '{{ addslashes($galeri->judul) }}'">

                    <img src="{{ asset('storage/'.$galeri->gambar) }}"
                         alt="{{ $galeri->judul }}"
                         loading="lazy"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                        <h5 class="text-base font-semibold text-white line-clamp-2 leading-snug">{{ $galeri->judul }}</h5>
                    </div>

                </div>

            @empty

                <div class="col-span-1 sm:col-span-2 lg:col-span-3 py-20 text-center flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50">
                    <i class="fa-solid fa-images text-4xl text-slate-300 mb-4"></i>
                    <h5 class="text-lg font-semibold text-slate-700 mb-1">Galeri Belum Tersedia</h5>
                    <p class="text-sm text-slate-500">Dokumentasi kegiatan akan ditampilkan setelah dipublikasikan oleh petugas.</p>
                </div>

            @endforelse

        </div>

    </div>

    {{-- Full Screen Modal --}}
    <template x-teleport="body">
        <div x-show="modalOpen" 
             style="display: none;"
             class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/95 backdrop-blur-sm p-4 sm:p-8"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
             
            {{-- Close Button --}}
            <button @click="modalOpen = false" 
                    class="absolute top-4 right-4 sm:top-6 sm:right-6 text-white/70 hover:text-white p-3 rounded-full bg-white/10 hover:bg-white/20 transition-all focus:outline-none focus:ring-2 focus:ring-white/50 group"
                    aria-label="Tutup modal">
                <i class="fa-solid fa-xmark text-xl transition-transform group-hover:rotate-90"></i>
            </button>

            {{-- Image Container --}}
            <div class="relative max-w-6xl w-full max-h-full flex flex-col items-center justify-center"
                 @click.away="modalOpen = false"
                 x-transition:enter="transition ease-out duration-300 transform delay-100"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4">
                
                <img :src="currentImage" :alt="currentTitle" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl ring-1 ring-white/10">
                
                <div class="mt-6 text-center max-w-3xl">
                    <h4 x-text="currentTitle" class="text-white text-lg sm:text-xl font-medium tracking-wide"></h4>
                </div>
            </div>
        </div>
    </template>
</section>