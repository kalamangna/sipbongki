{{-- ═══════════════════════════════════════════════
    HERO SECTION — Clean Style (Tailwind CSS)
═══════════════════════════════════════════════ --}}
<section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-slate-50">
    <div class="absolute inset-0 bg-gradient-to-b from-primary/5 to-transparent"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            {{-- ── LEFT: CONTENT ──────────────────── --}}
            <div class="text-center lg:text-left">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-primary-light text-primary mb-6 border border-primary/20 uppercase tracking-wider">
                    <i class="fa-solid fa-shield-halved"></i>
                    Sistem Informasi dan Pelayanan
                </span>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-800 leading-tight mb-4 drop-shadow-sm">
                    {{ $website?->judul_hero ?? 'Kelurahan' }}
                    <span class="text-primary">
                        {{ $website?->subjudul_hero ?? 'Bongki' }}
                    </span>
                </h1>
                
                <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                    <a href="{{ $website?->hero_button_1_link ?? '#layanan' }}"
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white text-sm font-semibold shadow-lg shadow-primary/30 transition-all duration-200 hover:-translate-y-0.5">
                        <i class="fa-solid fa-paper-plane"></i>
                        {{ $website?->hero_button_1_text ?? 'Ajukan Permohonan' }}
                    </a>
                    
                    <a href="{{ $website?->hero_button_2_link ?? '#layanan' }}"
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl border-2 border-primary text-primary text-sm font-semibold hover:bg-primary hover:text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                        <i class="fa-solid fa-grip"></i>
                        {{ $website?->hero_button_2_text ?? 'Lihat Layanan' }}
                    </a>
                </div>

                {{-- Info pills --}}
                <div class="flex flex-wrap justify-center lg:justify-start gap-3 mt-8">
                    <div class="flex items-center gap-2 bg-white border border-slate-200 shadow-sm rounded-full px-4 py-2 text-xs font-medium text-slate-600">
                        <i class="fa-solid fa-clock"></i>
                        {{ $website?->jam_pelayanan ?? '08.00 – 16.00 WITA' }}
                    </div>
                    <div class="flex items-center gap-2 bg-white border border-slate-200 shadow-sm rounded-full px-4 py-2 text-xs font-medium text-slate-600">
                        <i class="fa-solid fa-map"></i>
                        Kel. Bongki, Sinjai
                    </div>
                    @if($website?->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $website->whatsapp) }}"
                       target="_blank"
                       class="flex items-center gap-2 bg-white border border-slate-200 shadow-sm rounded-full px-4 py-2 text-xs font-medium text-slate-600 hover:text-primary transition-colors focus:outline-none focus:ring-2 focus:ring-primary/50">
                        <i class="fa-solid fa-phone"></i>
                        {{ $website->whatsapp }}
                    </a>
                    @endif
                </div>

            </div>

            {{-- ── RIGHT: IMAGE ────────────────────── --}}
            <div class="relative hidden lg:flex justify-end">
                <div class="absolute inset-0 bg-gradient-to-tr from-primary/20 to-transparent rounded-full blur-3xl transform -translate-x-10 translate-y-10"></div>
                <img src="{{ $website?->gambar_hero
                        ? asset('storage/'.$website->gambar_hero)
                        : asset('images/kantor.png') }}"
                     alt="Kantor Kelurahan Bongki"
                     class="relative z-10 w-full rounded-3xl shadow-2xl object-cover border-4 border-white transform hover:-translate-y-2 transition-transform duration-500">
            </div>

        </div>

        {{-- ── STATISTICS BAR ──────────────────── --}}
        <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            @php
                $stats = [
                    ['value' => number_format($jumlahPenduduk ?? 0),    'label' => 'Penduduk',       'icon' => 'fa-solid fa-users',        'bg' => 'bg-emerald-50',  'text' => 'text-emerald-600'],
                    ['value' => number_format($jumlahKK ?? 0),          'label' => 'Kartu Keluarga', 'icon' => 'fa-solid fa-house',        'bg' => 'bg-sky-50',      'text' => 'text-sky-600'],
                    ['value' => number_format($jumlahJenisSurat ?? 0),  'label' => 'Jenis Layanan',  'icon' => 'fa-solid fa-file-lines',   'bg' => 'bg-amber-50',    'text' => 'text-amber-600'],
                    ['value' => number_format($jumlahPerangkat ?? 0),   'label' => 'Perangkat',      'icon' => 'fa-solid fa-id-card',      'bg' => 'bg-violet-50',   'text' => 'text-violet-600'],
                ];
            @endphp

            @foreach($stats as $stat)
                <div class="bg-white border border-slate-100 shadow-sm rounded-2xl px-5 py-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl {{ $stat['bg'] }} flex items-center justify-center flex-shrink-0">
                        <i class="{{ $stat['icon'] }} w-5 h-5 {{ $stat['text'] }}"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-extrabold text-slate-800 leading-none mb-1">{{ $stat['value'] }}</div>
                        <div class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

</section>