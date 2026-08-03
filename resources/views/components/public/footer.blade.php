<footer id="kontak" class="bg-slate-900 text-slate-300 pt-16 pb-8 border-t border-slate-800">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-slate-800">

            {{-- Logo & Deskripsi --}}
            <div class="lg:col-span-4 space-y-4">
                <div class="flex items-center gap-3">
                    <img src="{{ $website?->logo ? asset('storage/'.$website->logo) : asset('images/sinjai.png') }}" class="w-12 h-12 object-contain" alt="Logo">
                    <div>
                        <h4 class="font-extrabold text-xl text-white tracking-tight">
                            {{ $website?->nama_website ?? 'SIP Bongki' }}
                        </h4>
                        <span class="text-xs font-semibold text-emerald-400 tracking-wide uppercase">
                            Pemerintah Kelurahan Bongki
                        </span>
                    </div>
                </div>

                <p class="text-sm text-slate-400 leading-relaxed">
                    {{ $website?->footer_text ?? 'Sistem Informasi dan Pelayanan Kelurahan Bongki yang memberikan pelayanan publik secara cepat, transparan dan profesional.' }}
                </p>
            </div>

            {{-- Menu Navigasi --}}
            <div class="lg:col-span-2 space-y-4">
                <h5 class="font-bold text-white text-base tracking-wide">Navigasi</h5>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:text-emerald-400 transition-colors">Beranda</a></li>
                    <li><a href="{{ url('/#profil') }}" class="hover:text-emerald-400 transition-colors">Profil</a></li>
                    <li><a href="{{ url('/#layanan') }}" class="hover:text-emerald-400 transition-colors">Layanan</a></li>
                    <li><a href="{{ url('/#berita') }}" class="hover:text-emerald-400 transition-colors">Berita</a></li>
                    <li><a href="{{ url('/#galeri') }}" class="hover:text-emerald-400 transition-colors">Galeri</a></li>
                    <li><a href="{{ route('pengaduan') }}" class="text-emerald-400 hover:underline">Pengaduan</a></li>
                </ul>
            </div>

            {{-- Layanan Utama --}}
            <div class="lg:col-span-3 space-y-4">
                <h5 class="font-bold text-white text-base tracking-wide">Layanan Mandiri</h5>
                <ul class="space-y-2.5 text-sm text-slate-400">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-xs text-emerald-400"></i> Surat Ket. Usaha</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-xs text-emerald-400"></i> Surat Ket. Belum Menikah</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-xs text-emerald-400"></i> Surat Ket. Domisili</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-xs text-emerald-400"></i> Surat Ket. Kematian</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-xs text-emerald-400"></i> Surat Ket. Kurang Mampu</li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div class="lg:col-span-3 space-y-4">
                <h5 class="font-bold text-white text-base tracking-wide">Kontak Kami</h5>
                <div class="space-y-3 text-sm text-slate-400">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-location-dot mt-1 text-emerald-400"></i>
                        <span>{{ $website?->alamat ?? 'Alamat Kantor Kelurahan' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-phone text-emerald-400"></i>
                        <span>{{ $website?->telepon ?? '-' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-envelope text-emerald-400"></i>
                        <span>{{ $website?->email ?? '-' }}</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="pt-8 text-center text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>Sistem Informasi &amp; Pelayanan Kelurahan Bongki (SIPBongki)</p>
            <p>{{ $website?->copyright ?? '© '.date('Y').' Kelurahan Bongki. Hak Cipta Dilindungi.' }}</p>
        </div>
    </div>
</footer>