<section id="profil" class="py-20 bg-slate-50">
    <div class="container mx-auto px-4 max-w-7xl space-y-16">

        {{-- HEADER SECTION --}}
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="inline-block px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs tracking-wider uppercase">
                Profil Wilayah
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Tentang Kelurahan Bongki
            </h2>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                Sejarah, visi dan misi, serta informasi mengenai Kelurahan Bongki sebagai pusat pelayanan pemerintahan dan kemasyarakatan.
            </p>
        </div>

        {{-- HERO PROFIL CARD --}}
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-100 shadow-xl grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-7 space-y-5">
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-50 text-emerald-700 font-bold text-xs rounded-full">
                    <i class="fa-solid fa-building"></i>
                    Pemerintah Kelurahan Bongki
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-snug">
                    Melayani Dengan Cepat, Transparan, dan Profesional
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Kelurahan Bongki merupakan salah satu wilayah di Kecamatan Sinjai Utara, Kabupaten Sinjai yang berkomitmen memberikan pelayanan publik terbaik melalui tata kelola pemerintahan yang modern dan berbasis digital melalui Sistem Informasi Pelayanan Kelurahan (SIPBongki).
                </p>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-4 border-t border-slate-100">
                    <div class="space-y-1">
                        <span class="text-xs font-semibold text-slate-400">Kecamatan</span>
                        <p class="font-bold text-sm text-slate-800">Sinjai Utara</p>
                    </div>
                    <div class="space-y-1">
                        <span class="text-xs font-semibold text-slate-400">Kabupaten</span>
                        <p class="font-bold text-sm text-slate-800">Sinjai</p>
                    </div>
                    <div class="space-y-1">
                        <span class="text-xs font-semibold text-slate-400">Provinsi</span>
                        <p class="font-bold text-sm text-slate-800">Sulawesi Selatan</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="rounded-2xl overflow-hidden shadow-lg border-2 border-slate-100 bg-slate-100 h-72">
                    <img src="{{ asset('images/kantorsatu.png') }}" alt="Kantor Kelurahan" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/kantor.png') }}'">
                </div>
            </div>
        </div>

        {{-- VISI & MISI CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- VISI --}}
            <div class="bg-gradient-to-br from-emerald-600 to-teal-700 text-white rounded-3xl p-8 shadow-xl space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-xl">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <h4 class="text-2xl font-black tracking-tight">Visi Kelurahan</h4>
                <p class="text-emerald-50 text-sm leading-relaxed">
                    "Terwujudnya Pelayanan Publik Kelurahan Bongki yang Prima, Transparan, Berbasis Digital, dan Berkelanjutan Demi Kesejahteraan Masyarakat."
                </p>
            </div>

            {{-- MISI --}}
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <h4 class="text-2xl font-black text-slate-900 tracking-tight">Misi Utama</h4>
                <ul class="space-y-2.5 text-slate-600 text-sm">
                    <li class="flex items-start gap-2.5">
                        <i class="fa-solid fa-circle-check text-emerald-600 mt-1 shrink-0 text-xs"></i>
                        <span>Meningkatkan kualitas pelayanan administrasi kependudukan yang cepat dan transparan.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <i class="fa-solid fa-circle-check text-emerald-600 mt-1 shrink-0 text-xs"></i>
                        <span>Mengembangkan sistem pelayanan berbasis digital untuk kemudahan masyarakat.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <i class="fa-solid fa-circle-check text-emerald-600 mt-1 shrink-0 text-xs"></i>
                        <span>Meningkatkan sarana dan prasarana lingkungan permukiman yang aman dan nyaman.</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</section>