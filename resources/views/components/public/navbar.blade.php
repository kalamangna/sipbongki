{{-- ═══════════════════════════════════════════════
    NAVBAR — Tailwind CSS (sesuai DESIGN.md)
    Primary: emerald | focus:ring-2 pada semua interaktif
═══════════════════════════════════════════════ --}}
<nav id="navbar"
     class="fixed top-0 inset-x-0 z-50 transition-all duration-300"
     x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
     :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-md' : 'bg-transparent'">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-3">

            {{-- ── BRAND ─────────────────────────── --}}
            <a href="{{ url('/') }}"
               class="flex items-center gap-3 focus:outline-none rounded-lg"
               aria-label="Beranda SIP Bongki">

                @if(isset($website) && $website?->logo)
                    <img src="{{ asset('storage/'.$website->logo) }}"
                         alt="Logo {{ $website->nama_kelurahan ?? 'Kelurahan Bongki' }}"
                         class="h-11 w-auto">
                @else
                    <img src="{{ asset('images/logo.png') }}"
                         alt="Logo Kelurahan Bongki"
                         class="h-11 w-auto">
                @endif

                <div class="leading-tight min-w-0">
                    <div class="text-sm font-bold transition-colors duration-300 text-slate-800 truncate max-w-[140px] sm:max-w-none">
                        {{ $website?->nama_website ?? 'SIP Bongki' }}
                    </div>
                    <div class="text-xs transition-colors duration-300 text-slate-500 truncate max-w-[140px] sm:max-w-none">
                        {{ $website?->nama_kelurahan ?? 'Kelurahan Bongki' }}
                    </div>
                </div>

            </a>

            {{-- ── RIGHT ALIGNED: MENU + CTA ──────────────────── --}}
            <div class="flex items-center gap-4">
                {{-- ── DESKTOP MENU ──────────────────── --}}
                <ul class="hidden lg:flex items-center gap-1" role="navigation" aria-label="Menu utama">
                    @php
                        $navLinks = [
                            ['href' => url('/'),                        'label' => 'Beranda'],
                            ['href' => url('/#profil'),                 'label' => 'Profil'],
                            ['href' => url('/#struktur-organisasi'),    'label' => 'Organisasi'],
                        ];
                        if($website->tampilkan_statistik ?? true)
                            $navLinks[] = ['href' => url('/#statistik'), 'label' => 'Statistik'];
                        if($website->tampilkan_layanan ?? true)
                            $navLinks[] = ['href' => url('/#layanan'),   'label' => 'Layanan'];
                        if($website->tampilkan_berita ?? true)
                            $navLinks[] = ['href' => url('/#berita'),    'label' => 'Berita'];
                        if($website->tampilkan_galeri ?? true)
                            $navLinks[] = ['href' => url('/#galeri'),    'label' => 'Galeri'];
                        
                        $navLinks[] = ['href' => url('/#kontak'),        'label' => 'Kontak'];
                        $navLinks[] = ['href' => route('pengaduan'),    'label' => 'Pengaduan'];
                    @endphp

                    @foreach($navLinks as $link)
                        <li>
                            <a href="{{ $link['href'] }}"
                               class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                                      focus:outline-none text-slate-600 hover:text-primary hover:bg-primary-light">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                {{-- ── CTA + HAMBURGER ──────────────── --}}
                <div class="flex items-center gap-3 border-l lg:border-slate-200 lg:pl-4 border-transparent pl-0">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="hidden lg:inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold
                                  transition-all duration-200 active:scale-95
                                  focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 bg-primary text-white hover:bg-primary-dark shadow-md shadow-primary/20">
                            <i class="fa-solid fa-gauge"></i>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="hidden lg:inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold
                                  transition-all duration-200 active:scale-95
                                  focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 bg-primary text-white hover:bg-primary-dark shadow-md shadow-primary/20">
                            <i class="fa-solid fa-arrow-right"></i>
                            Login
                        </a>
                    @endauth

                    {{-- Hamburger — min h-11 w-11 sesuai touch target DESIGN.md --}}
                    <button @click="open = !open"
                            aria-label="Buka menu"
                            :aria-expanded="open"
                            class="lg:hidden h-11 w-11 flex items-center justify-center rounded-xl transition-colors
                                   focus:outline-none focus:ring-2 focus:ring-primary text-slate-700 hover:bg-slate-100">
                        <i class="fa-solid fa-bars" x-show="!open"></i>
                        <i class="fa-solid fa-xmark" x-show="open" style="display: none;"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- ── MOBILE MENU ───────────────────────── --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden bg-white border-t border-slate-100 shadow-xl"
         role="navigation" aria-label="Menu mobile">

        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col gap-1">

            @foreach($navLinks as $link)
                <a href="{{ $link['href'] }}"
                   @click="open = false"
                   class="px-4 py-3 rounded-xl text-sm font-medium text-slate-700
                          hover:bg-primary-light hover:text-primary
                          focus:outline-none focus:ring-2 focus:ring-primary
                          transition-colors">
                    {{ $link['label'] }}
                </a>
            @endforeach

            <div class="pt-3 mt-2 border-t border-slate-100 px-2 pb-2">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold
                              transition-all duration-200 active:scale-95
                              focus:outline-none focus:ring-2 focus:ring-primary bg-primary text-white hover:bg-primary-dark shadow-md shadow-primary/20 w-full">
                        <i class="fa-solid fa-gauge"></i>
                        Ke Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold
                              transition-all duration-200 active:scale-95
                              focus:outline-none focus:ring-2 focus:ring-primary bg-primary text-white hover:bg-primary-dark shadow-md shadow-primary/20 w-full">
                        <i class="fa-solid fa-arrow-right"></i>
                        Login
                    </a>
                @endauth
            </div>

        </div>
    </div>

</nav>