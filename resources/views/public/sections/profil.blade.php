{{-- ═══════════════════════════════════════════════
    PROFIL SECTION — Tailwind CSS (sesuai DESIGN.md)
    Accordion pakai Alpine.js (tanpa Bootstrap JS)
═══════════════════════════════════════════════ --}}
<section id="profil" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary mb-4">Profil Kelurahan Bongki</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Mengenal Kelurahan Bongki</h2>
        </div>

        {{-- ── HERO PROFIL ────────────────────────── --}}
        <div class="grid lg:grid-cols-2 gap-10 items-center mb-16">

            <div>
                <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-primary mb-4">
                    <i class="fa-solid fa-building"></i>
                    Pemerintah Kelurahan Bongki
                </span>

                <h3 class="text-2xl md:text-3xl font-bold text-slate-800 leading-snug mb-4">
                    Mewujudkan pelayanan publik yang mudah, cepat, transparan,
                    dan profesional bagi seluruh warga.
                </h3>

                <p class="text-slate-500 leading-relaxed">
                    Kelurahan Bongki berkomitmen memberikan layanan pemerintahan yang responsif
                    dan berorientasi pada kebutuhan warga, selaras dengan visi misi Bupati Sinjai
                    dan RPJMD Kabupaten Sinjai melalui inovasi digital SIP Bongki.
                </p>

                {{-- Quick facts --}}
                <div class="grid grid-cols-2 gap-3 mt-6">
                    @foreach([
                        ['icon' => 'fa-solid fa-map',        'label' => 'Luas Wilayah',    'value' => '4,81 Km²'],
                        ['icon' => 'fa-solid fa-grip',  'label' => 'Lingkungan',       'value' => '4 Lingkungan'],
                        ['icon' => 'fa-solid fa-map-pin',    'label' => 'Kecamatan',        'value' => 'Sinjai Utara'],
                        ['icon' => 'fa-solid fa-shield-halved',     'label' => 'Kabupaten',        'value' => 'Sinjai'],
                    ] as $fact)
                        <div class="flex items-center gap-3 bg-slate-50 rounded-xl p-3">
                            <div class="w-9 h-9 rounded-lg bg-primary-light flex items-center justify-center flex-shrink-0">
                                <i class="{{ $fact['icon'] }} w-5 h-5 text-primary"></i>
                            </div>
                            <div>
                                <div class="text-[10px] text-slate-400 uppercase tracking-wider">{{ $fact['label'] }}</div>
                                <div class="text-sm font-semibold text-slate-700">{{ $fact['value'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-br from-primary-light to-emerald-100 rounded-3xl -z-10"></div>
                <img src="{{ asset('images/kantorsatu.png') }}"
                     alt="Kantor Kelurahan Bongki"
                     class="w-full rounded-2xl shadow-xl object-cover">
            </div>

        </div>

        {{-- ── CONTENT: PROFIL + ACCORDION ────────── --}}
        <div class="grid lg:grid-cols-2 gap-8 items-start">

            {{-- Profil Kelurahan --}}
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">

                <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-primary mb-4">
                    <i class="fa-solid fa-circle-info"></i>
                    Informasi Umum
                </div>

                <h3 class="text-xl font-bold text-slate-800 mb-3">
                    {{ $halamanProfil['profil-kelurahan']->judul ?? 'Profil Kelurahan Bongki' }}
                </h3>

                <div class="w-12 h-1 bg-primary rounded-full mb-4"></div>

                <div class="prose prose-sm prose-slate max-w-none text-slate-600 leading-relaxed">
                    {!! $halamanProfil['profil-kelurahan']->isi ??
                    '<p>Kelurahan Bongki merupakan salah satu kelurahan di Kecamatan Sinjai Utara,
                    Kabupaten Sinjai, Provinsi Sulawesi Selatan yang memiliki peran penting sebagai
                    pusat pelayanan pemerintahan, pembangunan, dan pemberdayaan masyarakat.</p>
                    <p>Dengan luas wilayah sekitar <strong>4,81 Km²</strong>, Kelurahan Bongki terdiri
                    atas empat lingkungan, yaitu Paruntu, Popanda, Benteng, dan Samaenre.</p>
                    <p>Melalui inovasi pelayanan digital <strong>SIP Bongki</strong>, masyarakat dapat
                    memperoleh berbagai informasi dan pelayanan administrasi secara lebih mudah,
                    efektif, dan efisien.</p>' !!}
                </div>

            </div>

            {{-- Accordion Alpine.js — Sejarah, Visi Misi, Monografi, Batas Wilayah --}}
            <div x-data="{ open: 'sejarah' }" class="flex flex-col gap-3">

                @php
                    $accordionItems = [
                        [
                            'id'    => 'sejarah',
                            'icon'  => 'fa-solid fa-clock',
                            'color' => 'text-amber-500',
                            'bg'    => 'bg-amber-50',
                            'label' => 'Sejarah Kelurahan',
                            'body'  => '
                                <p>Kelurahan Bongki merupakan salah satu kelurahan yang berada di wilayah
                                Kecamatan Sinjai Utara, Kabupaten Sinjai, Provinsi Sulawesi Selatan.</p>
                                <p class="mt-2">Seiring perkembangan wilayah, pada awalnya Kelurahan Bongki
                                terdiri atas dua lingkungan: Lingkungan Paruntu dan Lingkungan Benteng.</p>
                                <div class="mt-3 p-4 bg-amber-50 rounded-xl border border-amber-100">
                                    <p class="font-semibold text-slate-700 mb-2">Pemekaran Wilayah Tahun 2002</p>
                                    <p class="text-xs text-slate-500 mb-2">Berdasarkan SK Camat Sinjai Utara No. 01/I/2002/SUT tanggal 7 Januari 2002, terbentuk empat lingkungan:</p>
                                    <ul class="space-y-1 text-sm text-slate-600">
                                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500 inline-block" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg> Lingkungan Paruntu</li>
                                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500 inline-block" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg> Lingkungan Popanda</li>
                                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500 inline-block" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg> Lingkungan Benteng</li>
                                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-emerald-500 inline-block" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg> Lingkungan Samaenre</li>
                                    </ul>
                                </div>
                            ',
                        ],
                        [
                            'id'    => 'visi',
                            'icon'  => 'fa-solid fa-star',
                            'color' => 'text-primary',
                            'bg'    => 'bg-primary-light',
                            'label' => 'Visi & Misi',
                            'body'  => '
                                <div class="p-4 bg-primary-light rounded-xl border border-emerald-100 mb-3">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-primary mb-2">Visi</p>
                                    <p class="text-sm text-slate-700 italic leading-relaxed">"Terwujudnya Kelurahan Bongki yang maju, mandiri, sejahtera, religius, berdaya saing, dan berbasis pelayanan publik digital yang inklusif."</p>
                                </div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2 mt-3">Misi</p>
                                <ol class="space-y-2">
                                    <li class="flex gap-2 text-sm text-slate-600"><span class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-xs flex-shrink-0 mt-0.5">1</span> Meningkatkan kualitas pelayanan publik yang cepat, mudah, dan transparan.</li>
                                    <li class="flex gap-2 text-sm text-slate-600"><span class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-xs flex-shrink-0 mt-0.5">2</span> Mewujudkan tata kelola pemerintahan yang profesional dan akuntabel.</li>
                                    <li class="flex gap-2 text-sm text-slate-600"><span class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-xs flex-shrink-0 mt-0.5">3</span> Mendorong partisipasi aktif masyarakat dalam pembangunan berkelanjutan.</li>
                                    <li class="flex gap-2 text-sm text-slate-600"><span class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-xs flex-shrink-0 mt-0.5">4</span> Mengembangkan ekonomi lokal dengan potensi sumber daya daerah.</li>
                                    <li class="flex gap-2 text-sm text-slate-600"><span class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-xs flex-shrink-0 mt-0.5">5</span> Meningkatkan kualitas lingkungan hidup yang bersih, sehat, dan nyaman.</li>
                                    <li class="flex gap-2 text-sm text-slate-600"><span class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-xs flex-shrink-0 mt-0.5">6</span> Memperkuat penggunaan teknologi digital untuk pelayanan publik.</li>
                                </ol>
                            ',
                        ],
                        [
                            'id'    => 'monografi',
                            'icon'  => 'fa-solid fa-chart-bar',
                            'color' => 'text-sky-500',
                            'bg'    => 'bg-sky-50',
                            'label' => 'Monografi Kelurahan',
                            'body'  => '
                                <div class="grid grid-cols-1 gap-3">
                                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                                        <p class="text-xs font-semibold text-slate-500 mb-1">Gambaran Umum</p>
                                        <p class="text-sm text-slate-600">Kelurahan di Kecamatan Sinjai Utara yang berkomitmen memberikan pelayanan publik profesional dan berorientasi pada kepuasan masyarakat.</p>
                                    </div>
                                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                                        <p class="text-xs font-semibold text-slate-500 mb-1">Kondisi Geografis</p>
                                        <p class="text-sm text-slate-600">Lokasi strategis yang mudah dijangkau dari pusat pemerintahan, pendidikan, kesehatan, dan perdagangan.</p>
                                    </div>
                                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                                        <p class="text-xs font-semibold text-slate-500 mb-1">Potensi Wilayah</p>
                                        <p class="text-sm text-slate-600">Memiliki potensi pada sektor perdagangan, jasa, UMKM, dan sumber daya manusia yang aktif dalam pembangunan.</p>
                                    </div>
                                </div>
                            ',
                        ],
                        [
                            'id'    => 'batas',
                            'icon'  => 'fa-solid fa-map',
                            'color' => 'text-rose-500',
                            'bg'    => 'bg-rose-50',
                            'label' => 'Batas Wilayah',
                            'body'  => '
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-center">
                                        <svg class="w-6 h-6 text-slate-400 mx-auto mb-1 block" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" /></svg>
                                        <p class="text-[10px] text-slate-400 uppercase tracking-wider">Utara</p>
                                        <p class="text-sm font-semibold text-slate-700">Kabupaten Bone</p>
                                    </div>
                                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-center">
                                        <svg class="w-6 h-6 text-slate-400 mx-auto mb-1 block" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-3.707-7.293l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414z" clip-rule="evenodd" /></svg>
                                        <p class="text-[10px] text-slate-400 uppercase tracking-wider">Selatan</p>
                                        <p class="text-sm font-semibold text-slate-700">Kel. Biringere</p>
                                    </div>
                                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-center">
                                        <svg class="w-6 h-6 text-slate-400 mx-auto mb-1 block" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-2.707a1 1 0 00-1.414-1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3z" clip-rule="evenodd" /></svg>
                                        <p class="text-[10px] text-slate-400 uppercase tracking-wider">Timur</p>
                                        <p class="text-sm font-semibold text-slate-700">Kel. Balangnipa</p>
                                    </div>
                                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-center">
                                        <svg class="w-6 h-6 text-slate-400 mx-auto mb-1 block" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM6.293 9.293a1 1 0 011.414 1.414L9.414 12H13a1 1 0 110 2H9.414l-1.707 1.707a1 1 0 11-1.414-1.414l3-3-3-3z" clip-rule="evenodd" /></svg>
                                        <p class="text-[10px] text-slate-400 uppercase tracking-wider">Barat</p>
                                        <p class="text-sm font-semibold text-slate-700">Kel. Lamatti Rilau</p>
                                    </div>
                                </div>
                            ',
                        ],
                    ];
                @endphp

                @foreach($accordionItems as $item)
                    <div class="border rounded-2xl overflow-hidden transition-all duration-300"
                         :class="open === '{{ $item['id'] }}' ? 'border-primary ring-1 ring-primary/20 bg-white shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'">

                        <button @click="open = open === '{{ $item['id'] }}' ? null : '{{ $item['id'] }}'"
                                class="w-full flex items-center justify-between gap-4 px-5 py-4 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-primary"
                                :aria-expanded="open === '{{ $item['id'] }}'">

                            <span class="flex items-center gap-3">
                                <span class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors duration-300"
                                      :class="open === '{{ $item['id'] }}' ? 'bg-primary text-white' : '{{ $item['bg'] }}'">
                                    <i class="{{ $item['icon'] }} w-4 h-4 transition-colors duration-300"></i>
                                </span>
                                <span class="font-semibold text-sm md:text-base transition-colors duration-300"
                                      :class="open === '{{ $item['id'] }}' ? 'text-primary' : 'text-slate-800'">{{ $item['label'] }}</span>
                            </span>

                            <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full transition-colors duration-300"
                                  :class="open === '{{ $item['id'] }}' ? 'bg-primary/10' : 'bg-slate-50'">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>

                        </button>

                        <div x-show="open === '{{ $item['id'] }}'"
                             x-collapse
                             class="text-sm md:text-base text-slate-600 leading-relaxed">
                            <div class="px-5 pb-5 pt-2 border-t border-slate-100/60">
                                {!! $item['body'] !!}
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </div>
</section>