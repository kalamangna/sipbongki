{{-- ═══════════════════════════════════════════════
    SERVICES SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="layanan" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary mb-4">Pelayanan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Layanan Administrasi</h2>
        </div>

        @php
            $colorThemes = [
                // 0: Keterangan Usaha (Emerald khas Tailwind)
                [
                    'icon_bg'      => 'bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white',
                    'icon_color'   => 'text-emerald-600 group-hover:text-white',
                    'badge'        => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                    'btn'          => 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-600/20 focus:ring-emerald-500',
                    'hover_border' => 'hover:border-emerald-300',
                    'hover_title'  => 'group-hover:text-emerald-600',
                ],
                // 1: Surat Keterangan Belum Menikah (Rose khas Tailwind)
                [
                    'icon_bg'      => 'bg-rose-50 text-rose-600 group-hover:bg-rose-600 group-hover:text-white',
                    'icon_color'   => 'text-rose-600 group-hover:text-white',
                    'badge'        => 'bg-rose-50 text-rose-600 border-rose-200',
                    'btn'          => 'bg-rose-600 hover:bg-rose-700 shadow-rose-600/20 focus:ring-rose-500',
                    'hover_border' => 'hover:border-rose-300',
                    'hover_title'  => 'group-hover:text-rose-600',
                ],
                // 2: Surat Keterangan Domisili (Sky khas Tailwind)
                [
                    'icon_bg'      => 'bg-sky-50 text-sky-600 group-hover:bg-sky-600 group-hover:text-white',
                    'icon_color'   => 'text-sky-600 group-hover:text-white',
                    'badge'        => 'bg-sky-50 text-sky-600 border-sky-200',
                    'btn'          => 'bg-sky-600 hover:bg-sky-700 shadow-sky-600/20 focus:ring-sky-500',
                    'hover_border' => 'hover:border-sky-300',
                    'hover_title'  => 'group-hover:text-sky-600',
                ],
                // 3: Surat Keterangan Kematian (Slate khas Tailwind)
                [
                    'icon_bg'      => 'bg-slate-50 text-slate-600 group-hover:bg-slate-600 group-hover:text-white',
                    'icon_color'   => 'text-slate-600 group-hover:text-white',
                    'badge'        => 'bg-slate-50 text-slate-600 border-slate-200',
                    'btn'          => 'bg-slate-600 hover:bg-slate-700 shadow-slate-600/20 focus:ring-slate-500',
                    'hover_border' => 'hover:border-slate-300',
                    'hover_title'  => 'group-hover:text-slate-600',
                ],
                // 4: Surat Keterangan Orang Yang Sama (Indigo khas Tailwind)
                [
                    'icon_bg'      => 'bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white',
                    'icon_color'   => 'text-indigo-600 group-hover:text-white',
                    'badge'        => 'bg-indigo-50 text-indigo-600 border-indigo-200',
                    'btn'          => 'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-600/20 focus:ring-indigo-500',
                    'hover_border' => 'hover:border-indigo-300',
                    'hover_title'  => 'group-hover:text-indigo-600',
                ],
                // 5: Surat Keterangan Tidak Mampu (Amber khas Tailwind)
                [
                    'icon_bg'      => 'bg-amber-50 text-amber-600 group-hover:bg-amber-600 group-hover:text-white',
                    'icon_color'   => 'text-amber-600 group-hover:text-white',
                    'badge'        => 'bg-amber-50 text-amber-600 border-amber-200',
                    'btn'          => 'bg-amber-600 hover:bg-amber-700 shadow-amber-600/20 focus:ring-amber-500',
                    'hover_border' => 'hover:border-amber-300',
                    'hover_title'  => 'group-hover:text-amber-600',
                ],
            ];
        @endphp

        {{-- Cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($jenisSurats ?? [] as $jenisSurat)
                @php
                    $theme = $colorThemes[$loop->index % count($colorThemes)];
                @endphp

                <div class="group flex flex-col bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:-translate-y-0.5 {{ $theme['hover_border'] }} transition-all duration-300">

                    {{-- Top bar: Icon + Nomor Card --}}
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-14 h-14 rounded-2xl {{ $theme['icon_bg'] }} flex items-center justify-center transition-colors duration-300">
                            <i class="{{ $jenisSurat->icon ?? 'fa-solid fa-file-lines' }} {{ $theme['icon_color'] }} transition-colors text-2xl"></i>
                        </div>
                        <span class="inline-flex items-center justify-center px-2.5 py-1 text-xs font-bold rounded-lg border {{ $theme['badge'] }} tracking-wider">
                            #{{ sprintf('%02d', $loop->iteration) }}
                        </span>
                    </div>

                    <h3 class="text-base font-bold text-slate-800 mb-2 {{ $theme['hover_title'] }} transition-colors">
                        {{ $jenisSurat->nama }}
                    </h3>

                    <p class="text-sm text-slate-500 leading-relaxed flex-1">
                        {{ $jenisSurat->deskripsi ?: 'Pelayanan administrasi Kelurahan Bongki.' }}
                    </p>

                    <div class="mt-5 pt-4 border-t border-slate-100">
                        <a href="{{ route('permohonan.create', ['jenis' => $jenisSurat->id]) }}"
                           class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl {{ $theme['btn'] }} text-white text-sm font-semibold transition-all duration-200 active:scale-95 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2">
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                            Ajukan Permohonan
                        </a>
                    </div>

                </div>

            @empty

                <div class="sm:col-span-2 lg:col-span-3 py-16 text-center text-slate-400">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-3 text-slate-400 text-2xl">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <h4 class="text-base font-semibold text-slate-700 mb-1">Belum Ada Layanan</h4>
                    <p class="text-sm text-slate-500 max-w-sm mx-auto">Jenis pelayanan akan ditampilkan setelah dipublikasikan melalui Dashboard Admin.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>