{{-- ═══════════════════════════════════════════════
    WORKFLOW SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="alur-pelayanan" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14 max-w-2xl mx-auto">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase bg-primary-light text-primary mb-4">
                Alur Pelayanan
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Tahapan Permohonan</h2>
        </div>

        <div class="relative">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10">

                {{-- STEP 1 --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 text-center flex flex-col items-center">
                    <div class="w-full flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-sky-100 text-sky-700 text-xs font-bold font-mono">01</span>
                        <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Langkah 1</span>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-2xl mb-4">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-1.5">Ajukan Permohonan</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Pilih jenis layanan dan lengkapi data permohonan surat secara online.</p>
                </div>

                {{-- STEP 2 --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 text-center flex flex-col items-center">
                    <div class="w-full flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-amber-100 text-amber-800 text-xs font-bold font-mono">02</span>
                        <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Langkah 2</span>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mb-4">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-1.5">Verifikasi Berkas</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Petugas kelurahan memeriksa keabsahan dan kelengkapan berkas pemohon.</p>
                </div>

                {{-- STEP 3 --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 text-center flex flex-col items-center">
                    <div class="w-full flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 text-xs font-bold font-mono">03</span>
                        <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Langkah 3</span>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl mb-4">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-1.5">Proses Surat</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Penerbitan format resmi dan penandatanganan oleh pejabat yang berwenang.</p>
                </div>

                {{-- STEP 4 --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 text-center flex flex-col items-center">
                    <div class="w-full flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 text-xs font-bold font-mono">04</span>
                        <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Langkah 4</span>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mb-4">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-1.5">Surat Selesai</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Dokumen surat selesai diproses dan siap diambil atau diunduh langsung.</p>
                </div>

            </div>
        </div>

    </div>
</section>