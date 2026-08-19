{{-- ═══════════════════════════════════════════════
    STRUKTUR ORGANISASI — Tailwind CSS (sesuai DESIGN.md)
    Menggunakan <details> HTML native yang distilisasi
═══════════════════════════════════════════════ --}}
<section id="struktur-organisasi" class="py-24 bg-slate-50 dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @php $halaman = $halamanProfil['struktur-organisasi'] ?? null; @endphp

        {{-- Header --}}
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary dark:bg-primary-950/60 dark:text-primary-300 mb-4">Pemerintah Kelurahan Bongki</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-slate-100 mb-4">Struktur Organisasi</h2>
        </div>

        {{-- Struktur --}}
        <div class="flex flex-col gap-4">

            @foreach($struktur as $jabatanRoot)

                @php
                    $lurah           = $jabatanRoot->perangkatStruktur;
                    $sekretaris      = $jabatanRoot->children->whereIn('slug', ['sekretaris','sekretaris-lurah'])->first();
                    $kepalaLingkungan = $jabatanRoot->children->filter(fn ($i) => str_starts_with($i->slug, 'kepala-lingkungan'));
                @endphp

                {{-- Group: Lurah --}}
                <div x-data="{ open: true }" class="border rounded-2xl overflow-hidden transition-all duration-300"
                     :class="open ? 'border-primary ring-1 ring-primary/20 bg-white shadow-sm dark:bg-slate-900 dark:border-primary' : 'border-slate-200 bg-white hover:border-slate-300 dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700'">
                    
                    <button @click="open = !open"
                            class="w-full flex items-center justify-between gap-4 px-6 py-4 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-primary cursor-pointer"
                            :aria-expanded="open">
                        <span class="flex items-center gap-3">
                            <span class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors duration-300"
                                  :class="open ? 'bg-primary text-white' : 'bg-primary-light dark:bg-primary-950/60 text-primary dark:text-primary-400'">
                                <i class="fa-solid fa-id-badge"></i>
                            </span>
                            <span class="font-semibold text-sm md:text-base transition-colors duration-300"
                                  :class="open ? 'text-primary dark:text-primary-400' : 'text-slate-800 dark:text-slate-200'">Lurah</span>
                        </span>
                        <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full transition-colors duration-300"
                              :class="open ? 'bg-primary/10 dark:bg-primary-950/60 text-primary dark:text-primary-400' : 'bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-400'">
                            <i class="fa-solid fa-chevron-down"></i>
                        </span>
                    </button>
                    
                    <div x-show="open" x-collapse class="text-sm md:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                        <div class="px-6 pb-6 pt-2 border-t border-slate-100/60 dark:border-slate-800">
                            <div class="flex flex-wrap justify-center gap-6 mt-4">
                                @foreach($lurah as $perangkat)
                                    <x-public.person-card :perangkat="$perangkat" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Group: Sekretaris --}}
                @if($sekretaris)
                    <div x-data="{ open: false }" class="border rounded-2xl overflow-hidden transition-all duration-300"
                         :class="open ? 'border-sky-500 ring-1 ring-sky-500/20 bg-white shadow-sm dark:bg-slate-900 dark:border-sky-500' : 'border-slate-200 bg-white hover:border-slate-300 dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700'">
                        
                        <button @click="open = !open"
                                class="w-full flex items-center justify-between gap-4 px-6 py-4 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-sky-500 cursor-pointer"
                                :aria-expanded="open">
                            <span class="flex items-center gap-3">
                                <span class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors duration-300"
                                      :class="open ? 'bg-sky-500 text-white' : 'bg-sky-50 dark:bg-sky-950/60 text-sky-600 dark:text-sky-400'">
                                    <i class="fa-solid fa-book-open"></i>
                                </span>
                                <span class="font-semibold text-sm md:text-base transition-colors duration-300"
                                      :class="open ? 'text-sky-600 dark:text-sky-400' : 'text-slate-800 dark:text-slate-200'">Sekretaris</span>
                            </span>
                            <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full transition-colors duration-300"
                                  :class="open ? 'bg-sky-500/10 dark:bg-sky-950/60 text-sky-600 dark:text-sky-400' : 'bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-400'">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </button>
                        
                        <div x-show="open" x-collapse class="text-sm md:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                            <div class="px-6 pb-6 pt-2 border-t border-slate-100/60 dark:border-slate-800">
                                <div class="flex flex-wrap justify-center gap-6 mt-4">
                                    @foreach($sekretaris->perangkatStruktur as $perangkat)
                                        <x-public.person-card :perangkat="$perangkat" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Group: Kepala Lingkungan --}}
                @if($kepalaLingkungan->isNotEmpty())
                    <div x-data="{ open: false }" class="border rounded-2xl overflow-hidden transition-all duration-300"
                         :class="open ? 'border-amber-500 ring-1 ring-amber-500/20 bg-white shadow-sm dark:bg-slate-900 dark:border-amber-500' : 'border-slate-200 bg-white hover:border-slate-300 dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700'">
                        
                        <button @click="open = !open"
                                class="w-full flex items-center justify-between gap-4 px-6 py-4 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-amber-500 cursor-pointer"
                                :aria-expanded="open">
                            <span class="flex items-center gap-3">
                                <span class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors duration-300"
                                      :class="open ? 'bg-amber-500 text-white' : 'bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400'">
                                    <i class="fa-solid fa-house"></i>
                                </span>
                                <span class="font-semibold text-sm md:text-base transition-colors duration-300"
                                      :class="open ? 'text-amber-600 dark:text-amber-400' : 'text-slate-800 dark:text-slate-200'">Kepala Lingkungan</span>
                            </span>
                            <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full transition-colors duration-300"
                                  :class="open ? 'bg-amber-500/10 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400' : 'bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-400'">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </button>
                        
                        <div x-show="open" x-collapse class="text-sm md:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                            <div class="px-6 pb-6 pt-2 border-t border-slate-100/60 dark:border-slate-800">
                                @foreach($kepalaLingkungan as $lingkungan)
                                    <div x-data="{ open: false }" class="mt-3 border rounded-xl overflow-hidden transition-all duration-300"
                                         :class="open ? 'border-amber-200 bg-amber-50/30 dark:border-amber-800/60 dark:bg-amber-950/20' : 'border-slate-200 bg-slate-50 hover:border-slate-300 dark:bg-slate-800/60 dark:border-slate-700 dark:hover:border-slate-600'">
                                        <button @click="open = !open"
                                                class="w-full flex items-center justify-between px-4 py-3 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-amber-500 cursor-pointer">
                                            <span class="text-sm font-semibold transition-colors duration-300"
                                                  :class="open ? 'text-amber-600 dark:text-amber-400' : 'text-slate-700 dark:text-slate-300'">{{ $lingkungan->nama }}</span>
                                            <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full transition-colors duration-300"
                                                  :class="open ? 'bg-amber-100 dark:bg-amber-900/60 text-amber-600 dark:text-amber-400' : 'bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-400'">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </span>
                                        </button>
                                        <div x-show="open" x-collapse>
                                            <div class="px-4 pb-4 pt-1 flex flex-wrap justify-center gap-6">
                                                @foreach($lingkungan->perangkatStruktur as $perangkat)
                                                    <x-public.person-card :perangkat="$perangkat" />
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Group: Kepala Seksi & Staf --}}
                @if($sekretaris && $sekretaris->children->isNotEmpty())
                    <div x-data="{ open: false }" class="border rounded-2xl overflow-hidden transition-all duration-300"
                         :class="open ? 'border-violet-500 ring-1 ring-violet-500/20 bg-white shadow-sm dark:bg-slate-900 dark:border-violet-500' : 'border-slate-200 bg-white hover:border-slate-300 dark:bg-slate-900 dark:border-slate-800 dark:hover:border-slate-700'">
                        
                        <button @click="open = !open"
                                class="w-full flex items-center justify-between gap-4 px-6 py-4 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-violet-500 cursor-pointer"
                                :aria-expanded="open">
                            <span class="flex items-center gap-3">
                                <span class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors duration-300"
                                      :class="open ? 'bg-violet-500 text-white' : 'bg-violet-50 dark:bg-violet-950/60 text-violet-600 dark:text-violet-400'">
                                    <i class="fa-solid fa-users"></i>
                                </span>
                                <span class="font-semibold text-sm md:text-base transition-colors duration-300"
                                      :class="open ? 'text-violet-600 dark:text-violet-400' : 'text-slate-800 dark:text-slate-200'">Kepala Seksi & Staf</span>
                            </span>
                            <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full transition-colors duration-300"
                                  :class="open ? 'bg-violet-500/10 dark:bg-violet-950/60 text-violet-600 dark:text-violet-400' : 'bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-400'">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </button>
                        
                        <div x-show="open" x-collapse class="text-sm md:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                            <div class="px-6 pb-6 pt-2 border-t border-slate-100/60 dark:border-slate-800">
                                @foreach($sekretaris->children as $kasi)
                                    <div x-data="{ open: false }" class="mt-3 border rounded-xl overflow-hidden transition-all duration-300"
                                         :class="open ? 'border-violet-200 bg-violet-50/30 dark:border-violet-800/60 dark:bg-violet-950/20' : 'border-slate-200 bg-slate-50 hover:border-slate-300 dark:bg-slate-800/60 dark:border-slate-700 dark:hover:border-slate-600'">
                                        <button @click="open = !open"
                                                class="w-full flex items-center justify-between px-4 py-3 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-violet-500 cursor-pointer">
                                            <span class="text-sm font-semibold transition-colors duration-300"
                                                  :class="open ? 'text-violet-600 dark:text-violet-400' : 'text-slate-700 dark:text-slate-300'">{{ $kasi->nama }}</span>
                                            <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full transition-colors duration-300"
                                                  :class="open ? 'bg-violet-100 dark:bg-violet-900/60 text-violet-600 dark:text-violet-400' : 'bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-400'">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </span>
                                        </button>
                                        <div x-show="open" x-collapse>
                                            <div class="px-4 pb-4 pt-1 flex flex-wrap justify-center gap-6 mt-2">
                                                @foreach($kasi->perangkatStruktur as $perangkat)
                                                    <x-public.person-card :perangkat="$perangkat" />
                                                @endforeach
                                            </div>
                                            @if($kasi->children->isNotEmpty())
                                                <div class="px-4 pb-4">
                                                    @foreach($kasi->children as $staf)
                                                        <div x-data="{ open: false }" class="mt-2 border rounded-xl overflow-hidden transition-all duration-300"
                                                             :class="open ? 'border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-800' : 'border-slate-200 bg-white hover:border-slate-300 dark:border-slate-800 dark:bg-slate-800/60 dark:hover:border-slate-700'">
                                                            <button @click="open = !open"
                                                                    class="w-full flex items-center justify-between px-3 py-2.5 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-violet-500 cursor-pointer">
                                                                <span class="text-xs font-medium transition-colors duration-300"
                                                                      :class="open ? 'text-slate-800 dark:text-slate-100' : 'text-slate-600 dark:text-slate-400'">{{ $staf->nama }}</span>
                                                                <span class="flex-shrink-0 w-5 h-5 flex items-center justify-center rounded-full transition-colors duration-300"
                                                                      :class="open ? 'bg-slate-100 dark:bg-slate-700' : 'bg-slate-50 dark:bg-slate-800'">
                                                                    <i class="fa-solid fa-chevron-down"></i>
                                                                </span>
                                                            </button>
                                                            <div x-show="open" x-collapse>
                                                                <div class="px-3 pb-3 pt-1 flex flex-wrap justify-center gap-5">
                                                                    @foreach($staf->perangkatStruktur as $pegawai)
                                                                        <x-public.person-card :perangkat="$pegawai" />
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach

        </div>

    </div>
</section>