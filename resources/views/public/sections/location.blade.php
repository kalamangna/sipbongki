<section id="kontak" class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            {{-- INFORMASI KONTAK --}}
            <div class="lg:col-span-5 space-y-6">
                <span class="inline-block px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs tracking-wider uppercase">
                    Lokasi Kantor
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Kunjungi Kantor Kelurahan
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Kami siap melayani kebutuhan administrasi dan informasi masyarakat Kelurahan Bongki secara langsung di kantor kami.
                </p>

                <div class="space-y-4 pt-4">
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h6 class="font-bold text-sm text-slate-900">Alamat Utama</h6>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $website?->alamat ?? 'Jl. Poros Kelurahan Bongki, Kec. Sinjai Utara, Kab. Sinjai' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h6 class="font-bold text-sm text-slate-900">Telepon & Kontak</h6>
                            <p class="text-xs text-slate-500 mt-1">{{ $website?->telepon ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h6 class="font-bold text-sm text-slate-900">Email Resmi</h6>
                            <p class="text-xs text-slate-500 mt-1">{{ $website?->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MAPS CONTAINER --}}
            <div class="lg:col-span-7">
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-100 h-96 sm:h-[450px] bg-slate-100">
                    @if($website?->google_maps)
                        {!! $website->google_maps !!}
                    @else
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15891.137452809051!2d120.244!3d-5.123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbe24097f5a8a6d%3A0x4030bfbca7c1e50!2sBongki%2C%20North%20Sinjai%2C%20Sinjai%20Regency%2C%20South%20Sulawesi!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" class="w-full h-full border-0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>