{{-- ═══════════════════════════════════════════════
    FOOTER — Tailwind CSS (sesuai DESIGN.md)
    Primary: emerald | Accent: amber | Neutral: slate
═══════════════════════════════════════════════ --}}
<footer id="kontak-footer" class="bg-slate-900 text-slate-300 border-t border-slate-800">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- ── BRAND ────────────────────────── --}}
            <div class="sm:col-span-2 lg:col-span-1">

                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ $website?->logo
                            ? asset('storage/'.$website->logo)
                            : asset('images/logo.png') }}"
                         alt="Logo {{ $website?->nama_kelurahan ?? 'Kelurahan Bongki' }}"
                         class="h-11 w-auto">
                    <div>
                        <div class="font-bold text-sm text-white">{{ $website?->nama_website ?? 'SIP Bongki' }}</div>
                        <div class="text-xs text-slate-400">Pemerintah Kelurahan Bongki</div>
                    </div>
                </div>

                <p class="text-sm text-slate-300 leading-relaxed">
                    {{ $website?->footer_text ?? 'Sistem Informasi dan Pelayanan Kelurahan Bongki yang memberikan pelayanan publik secara cepat, transparan dan profesional.' }}
                </p>

            </div>

            {{-- ── MENU ─────────────────────────── --}}
            <div>
                <h5 class="font-bold text-xs mb-4 uppercase tracking-wider text-white">Menu Navigasi</h5>
                <ul class="flex flex-col gap-2.5">
                    @php
                        $footerLinks = [
                            ['href' => url('/'),            'label' => 'Beranda'],
                            ['href' => url('/#profil'),     'label' => 'Profil'],
                        ];
                        if($website->tampilkan_layanan ?? true)
                            $footerLinks[] = ['href' => url('/#layanan'), 'label' => 'Layanan'];
                        $footerLinks[] = ['href' => url('/#kontak'),     'label' => 'Kontak'];
                        $footerLinks[] = ['href' => route('pengaduan'),  'label' => 'Pengaduan'];
                    @endphp

                    @foreach($footerLinks as $link)
                        <li>
                            <a href="{{ $link['href'] }}"
                               class="text-sm text-slate-300 hover:text-white transition-colors
                                      focus:outline-none focus:ring-2 focus:ring-primary rounded">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- ── LAYANAN ───────────────────────── --}}
            <div>
                <h5 class="font-bold text-xs mb-4 uppercase tracking-wider text-white">Layanan Populer</h5>
                <ul class="flex flex-col gap-2.5">
                    @php
                        $jenisSurats = \App\Models\JenisSurat::where('aktif', true)->orderBy('nomor_urut')->take(6)->get();
                    @endphp
                    @forelse($jenisSurats as $jenisSurat)
                        <li>
                            <a href="{{ route('permohonan.create', ['jenis' => $jenisSurat->id]) }}" class="text-sm text-slate-300 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-primary rounded">
                                {{ $jenisSurat->nama }}
                            </a>
                        </li>
                    @empty
                        <li class="text-sm text-slate-500">Belum ada layanan</li>
                    @endforelse
                </ul>
            </div>


            {{-- ── KONTAK ────────────────────────── --}}
            <div class="sm:col-span-2 lg:col-span-1">
                <h5 class="font-bold text-xs mb-4 uppercase tracking-wider text-white">Hubungi Kami</h5>
                <div class="flex flex-col gap-3">
                    @if($website?->alamat)
                        <div class="flex items-start gap-2.5 text-sm text-slate-300">
                            <i class="fa-solid fa-map-pin text-primary-400 mt-0.5 shrink-0"></i>
                            <span>{{ $website->alamat }}</span>
                        </div>
                    @endif
                    @if($website?->telepon)
                        <div class="flex items-center gap-2.5 text-sm text-slate-300">
                            <i class="fa-solid fa-phone text-primary-400 shrink-0"></i>
                            <span>{{ $website->telepon }}</span>
                        </div>
                    @endif
                    @if($website?->email)
                        <div class="flex items-center gap-2.5 text-sm text-slate-300">
                            <i class="fa-solid fa-envelope text-primary-400 shrink-0"></i>
                            <span>{{ $website->email }}</span>
                        </div>
                    @endif
                    @if($website?->whatsapp)
                        {{-- WhatsApp: warna merek asli (hijau) sesuai DESIGN.md --}}
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $website->whatsapp) }}"
                           target="_blank"
                           class="flex items-center gap-2.5 text-sm text-slate-300 hover:text-white transition-colors
                                  focus:outline-none focus:ring-2 focus:ring-primary rounded">
                            <i class="fa-brands fa-whatsapp text-emerald-400 text-base shrink-0"></i>
                            <span>{{ $website->whatsapp }}</span>
                        </a>
                    @endif
                </div>
            </div>

        </div>

    </div>

    {{-- ── COPYRIGHT ─────────────────────────── --}}
    <div class="border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
            <p class="text-center text-xs text-slate-500">
                {{ $website?->copyright ?? '© '.date('Y').' Kelurahan Bongki. All rights reserved.' }}
            </p>
        </div>
    </div>

</footer>