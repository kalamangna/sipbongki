{{-- ═══════════════════════════════════════════════
    HERO SECTION — Clean Style (Tailwind CSS)
═══════════════════════════════════════════════ --}}
<section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            {{-- ── LEFT: CONTENT ──────────────────── --}}
            <div class="text-center lg:text-left">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-white text-primary mb-6 border border-slate-200 shadow-sm uppercase tracking-wider">
                    <i class="fa-solid fa-shield-halved"></i>
                    {{ $website?->badge ?? 'Sistem Informasi dan Pelayanan' }}
                </span>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight mb-6">
                    {{ $website?->judul_hero ?? 'Kelurahan' }}
                    <span class="text-primary">
                        {{ $website?->subjudul_hero ?? 'Bongki' }}
                    </span>
                </h1>
                
                <p class="text-base sm:text-lg text-slate-600 leading-relaxed mb-8 max-w-2xl mx-auto lg:mx-0">
                    {{ $website?->deskripsi_hero ?? 'Portal resmi pelayanan administrasi dan informasi masyarakat. Kami berkomitmen memberikan layanan yang cepat, transparan, dan mudah diakses oleh seluruh warga.' }}
                </p>
                
                <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                    <a href="{{ $website?->hero_button_1_link ?? '#layanan' }}"
                       class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl bg-primary hover:bg-primary-dark text-white text-base font-bold transition duration-300 shadow-md shadow-primary/20 hover:-translate-y-0.5 focus:ring-2 focus:ring-primary focus:outline-none focus:ring-offset-2">
                        <i class="fa-solid fa-paper-plane text-lg"></i>
                        {{ $website?->hero_button_1_text ?? 'Ajukan Permohonan' }}
                    </a>
                    
                    <button type="button"
                            onclick="document.getElementById('cekStatusModal').classList.remove('hidden')"
                            class="cursor-pointer inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 text-base font-bold transition duration-300 shadow-sm hover:-translate-y-0.5 focus:ring-2 focus:ring-slate-400 focus:outline-none focus:ring-offset-2">
                        <i class="fa-solid fa-magnifying-glass text-lg text-primary"></i>
                        Cek Status Permohonan
                    </button>
                </div>

                {{-- Info pills --}}
                <div class="flex flex-wrap justify-center lg:justify-start gap-3 mt-10">
                    <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-2 text-xs font-medium text-slate-600">
                        <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-clock text-slate-500"></i>
                        </div>
                        {{ $website?->jam_pelayanan ?? '08.00 – 16.00 WITA' }}
                    </div>
                    <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-2 text-xs font-medium text-slate-600">
                        <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-map text-slate-500"></i>
                        </div>
                        Kel. Bongki, Sinjai
                    </div>
                    @if($website?->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $website->whatsapp) }}"
                       target="_blank"
                       class="flex items-center gap-2 bg-white border border-slate-200 rounded-full px-4 py-2 text-xs font-medium text-slate-600 hover:border-slate-300 transition duration-300 focus:ring-2 focus:ring-slate-400 focus:outline-none">
                        <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                            <i class="fa-brands fa-whatsapp text-green-600"></i>
                        </div>
                        {{ $website->whatsapp }}
                    </a>
                    @endif
                </div>

            </div>

            {{-- ── RIGHT: IMAGE ────────────────────── --}}
            <div class="relative hidden lg:flex justify-end">
                <img src="{{ (!empty($website?->gambar_hero))
                        ? asset('storage/'.$website->gambar_hero)
                        : asset('images/kantor.png') }}"
                     alt="Kantor Kelurahan Bongki"
                     class="w-full rounded-2xl shadow-md object-cover border border-slate-200">
            </div>

        </div>

        {{-- ── STATISTICS BAR ──────────────────── --}}
        <div class="mt-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            @php
                $stats = [
                    ['value' => number_format($jumlahPenduduk ?? 0),    'label' => 'Penduduk',       'icon' => 'fa-solid fa-users',        'bg' => 'bg-emerald-50',  'text' => 'text-emerald-600'],
                    ['value' => number_format($jumlahKK ?? 0),          'label' => 'Kartu Keluarga', 'icon' => 'fa-solid fa-house',        'bg' => 'bg-sky-50',      'text' => 'text-sky-600'],
                    ['value' => number_format($jumlahJenisSurat ?? 0),  'label' => 'Jenis Layanan',  'icon' => 'fa-solid fa-file-lines',   'bg' => 'bg-amber-50',    'text' => 'text-amber-600'],
                    ['value' => number_format($jumlahPerangkat ?? 0),   'label' => 'Perangkat',      'icon' => 'fa-solid fa-id-card',      'bg' => 'bg-violet-50',   'text' => 'text-violet-600'],
                ];
            @endphp

            @foreach($stats as $stat)
                <div class="bg-white border border-slate-200 shadow-sm rounded-xl px-5 py-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg {{ $stat['bg'] }} flex items-center justify-center flex-shrink-0">
                        <i class="{{ $stat['icon'] }} text-lg {{ $stat['text'] }}"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-slate-900 leading-none mb-1">{{ $stat['value'] }}</div>
                        <div class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</div>
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

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">

        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-bold text-slate-800">Cek Status Permohonan</h5>
            <button onclick="document.getElementById('cekStatusModal').classList.add('hidden')"
                    class="cursor-pointer w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form method="GET" action="{{ route('permohonan.status.check') }}">
            <p class="text-sm text-slate-500 mb-4">
                Masukkan <strong>Nomor Permohonan</strong> untuk mengecek status permohonan Anda.
                Contoh: <code class="text-xs bg-slate-100 px-1.5 py-0.5 rounded text-primary font-semibold">PMH-20260101010101</code>
            </p>

            <div class="flex flex-col gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nomor Permohonan <span class="text-red-500">*</span></label>
                    <input type="text" name="nomor" required
                           class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                           placeholder="Contoh: PMH-20260814123456">
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="button"
                        onclick="document.getElementById('cekStatusModal').classList.add('hidden')"
                        class="cursor-pointer flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-medium hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="submit"
                        class="cursor-pointer flex-1 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white text-sm font-semibold transition-colors">
                    Cek Status
                </button>
            </div>
        </form>

    </div>
</div>