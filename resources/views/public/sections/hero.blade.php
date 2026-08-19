{{-- ═══════════════════════════════════════════════
    HERO SECTION — Clean Style (Tailwind CSS)
═══════════════════════════════════════════════ --}}
<section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 bg-slate-50 border-b border-slate-200 dark:bg-slate-900/50 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            {{-- ── LEFT: CONTENT ──────────────────── --}}
            <div class="text-center lg:text-left">
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold bg-white text-primary mb-6 border border-slate-200 shadow-sm uppercase tracking-wider dark:bg-slate-800 dark:border-slate-700 dark:text-primary-400">
                    {{ $website?->badge ?? 'Sistem Informasi dan Pelayanan' }}
                </span>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-slate-100 leading-snug mb-6">
                    {{ $website?->judul_hero ?? 'Kelurahan' }}
                    <span class="text-primary dark:text-primary-400">
                        {{ $website?->subjudul_hero ?? 'Bongki' }}
                    </span>
                </h1>
                
                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed mb-8 max-w-2xl mx-auto lg:mx-0">
                    {{ $website?->deskripsi_hero ?? 'Portal resmi pelayanan administrasi dan informasi masyarakat. Kami berkomitmen memberikan layanan yang cepat, transparan, dan mudah diakses oleh seluruh warga.' }}
                </p>
                
                <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                    <a href="{{ $website?->hero_button_1_link ?? '#layanan' }}"
                       class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl bg-primary hover:bg-primary-dark text-white text-base font-bold transition-all duration-200 shadow-md shadow-primary/20 hover:-translate-y-0.5 active:scale-95 focus:ring-2 focus:ring-primary focus:outline-none focus:ring-offset-2">
                        <i class="fa-solid fa-paper-plane text-lg"></i>
                        {{ $website?->hero_button_1_text ?? 'Ajukan Permohonan' }}
                    </a>
                    
                    <button type="button"
                            onclick="document.getElementById('cekStatusModal').classList.remove('hidden')"
                            class="cursor-pointer inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 text-base font-bold transition-all duration-200 shadow-sm hover:-translate-y-0.5 active:scale-95 focus:ring-2 focus:ring-slate-400 focus:outline-none focus:ring-offset-2 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-700">
                        <i class="fa-solid fa-magnifying-glass text-lg text-primary dark:text-primary-400"></i>
                        Cek Status Permohonan
                    </button>
                </div>

                {{-- Info pills --}}
                <div class="flex flex-wrap justify-center lg:justify-start gap-3 mt-10">
                    <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-2 text-xs font-medium text-slate-600 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300">
                        <div class="w-6 h-6 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-clock text-slate-500 dark:text-slate-400"></i>
                        </div>
                        {{ $website?->jam_pelayanan ?? '08.00 – 16.00 WITA' }}
                    </div>
                    <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-2 text-xs font-medium text-slate-600 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300">
                        <div class="w-6 h-6 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-map text-slate-500 dark:text-slate-400"></i>
                        </div>
                        Kel. Bongki, Sinjai
                    </div>
                    @if($website?->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $website->whatsapp) }}"
                       target="_blank"
                       class="flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-2 text-xs font-medium text-slate-600 hover:border-slate-300 transition duration-300 focus:ring-2 focus:ring-slate-400 focus:outline-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-300 dark:hover:border-slate-600">
                        <div class="w-6 h-6 rounded-full bg-green-100 dark:bg-emerald-950/60 flex items-center justify-center shrink-0">
                            <i class="fa-brands fa-whatsapp text-green-600 dark:text-emerald-400"></i>
                        </div>
                        {{ $website->whatsapp }}
                    </a>
                    @endif
                </div>

            </div>

            {{-- ── RIGHT: IMAGE ────────────────────── --}}
            <div class="relative flex justify-center lg:justify-end">
                <img src="{{ (!empty($website?->gambar_hero))
                        ? asset('storage/'.$website->gambar_hero)
                        : asset('images/kantor.png') }}"
                     alt="Kantor Kelurahan Bongki"
                     class="w-full lg:w-auto rounded-2xl shadow-md object-cover border border-slate-200 dark:border-slate-800 aspect-video lg:aspect-auto max-h-80 lg:max-h-none">
            </div>

        </div>

        {{-- ── STATISTICS BAR ──────────────────── --}}
        <div class="mt-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            @php
                $stats = [
                    ['value' => number_format($jumlahPenduduk ?? 0),    'label' => 'Penduduk',       'icon' => 'fa-solid fa-users',        'bg' => 'bg-emerald-50 dark:bg-emerald-950/60',  'text' => 'text-emerald-600 dark:text-emerald-400'],
                    ['value' => number_format($jumlahKK ?? 0),          'label' => 'Kartu Keluarga', 'icon' => 'fa-solid fa-house',        'bg' => 'bg-sky-50 dark:bg-sky-950/60',      'text' => 'text-sky-600 dark:text-sky-400'],
                    ['value' => number_format($jumlahJenisSurat ?? 0),  'label' => 'Jenis Layanan',  'icon' => 'fa-solid fa-file-lines',   'bg' => 'bg-amber-50 dark:bg-amber-950/60',    'text' => 'text-amber-600 dark:text-amber-400'],
                    ['value' => number_format($jumlahPerangkat ?? 0),   'label' => 'Perangkat',      'icon' => 'fa-solid fa-id-card',      'bg' => 'bg-violet-50 dark:bg-violet-950/60',   'text' => 'text-violet-600 dark:text-violet-400'],
                ];
            @endphp

            @foreach($stats as $stat)
                <div class="bg-white border border-slate-200 shadow-sm rounded-xl px-5 py-5 flex items-center gap-4 dark:bg-slate-900 dark:border-slate-800">
                    <div class="w-12 h-12 rounded-lg {{ $stat['bg'] }} flex items-center justify-center flex-shrink-0">
                        <i class="{{ $stat['icon'] }} text-lg {{ $stat['text'] }}"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-slate-900 dark:text-slate-100 leading-none mb-1">{{ $stat['value'] }}</div>
                        <div class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ $stat['label'] }}</div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

</section>

{{-- Modal: Cek Status Permohonan --}}
<div id="cekStatusModal"
     class="hidden fixed inset-0 z-50 flex items-center justify-center px-4"
     x-data
     @keydown.escape.window="document.getElementById('cekStatusModal').classList.add('hidden')">

    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm cursor-pointer"
         onclick="document.getElementById('cekStatusModal').classList.add('hidden')"></div>

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 dark:bg-slate-900 dark:border dark:border-slate-800">

        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-bold text-slate-800 dark:text-slate-100">Cek Status Permohonan</h5>
            <button onclick="document.getElementById('cekStatusModal').classList.add('hidden')"
                    aria-label="Tutup modal"
                    class="cursor-pointer w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-400 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-400">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form method="GET" action="{{ route('permohonan.status.check') }}">
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">
                Masukkan <strong>Nomor Permohonan</strong> untuk mengecek status permohonan Anda.
                Contoh: <code class="text-xs bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-primary dark:text-primary-400 font-semibold">PMH-20260101010101</code>
            </p>

            <div class="flex flex-col gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Nomor Permohonan <span class="text-red-500">*</span></label>
                    <input type="text" name="nomor" required
                           class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                           placeholder="Contoh: PMH-20260814123456">
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="button"
                        onclick="document.getElementById('cekStatusModal').classList.add('hidden')"
                        class="cursor-pointer flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-medium hover:bg-slate-50 transition-all duration-200 active:scale-95 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                    Batal
                </button>
                <button type="submit"
                        class="cursor-pointer flex-1 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white text-sm font-semibold shadow-sm shadow-primary/20 transition-all duration-200 active:scale-95 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    Cek Status
                </button>
            </div>
        </form>

    </div>
</div>