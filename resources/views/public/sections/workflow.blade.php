{{-- ═══════════════════════════════════════════════
    WORKFLOW SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="alur-pelayanan" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16 max-w-2xl mx-auto">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-light text-primary text-xs font-semibold uppercase tracking-wider mb-4">
                Alur Pelayanan
            </span>
            <h2 class="text-3xl font-bold text-slate-800 mb-4">Tahapan Pengajuan</h2>
        </div>

        <div class="relative">
            {{-- Connecting Line (Desktop) --}}
            <div class="hidden lg:block absolute top-1/2 left-0 right-0 h-0.5 bg-slate-200 -translate-y-1/2 z-0"></div>

            <div class="grid lg:grid-cols-4 gap-8 relative z-10">

                {{-- STEP 1 --}}
                <div class="relative bg-white rounded-2xl p-6 shadow-sm border border-slate-100 text-center hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div class="absolute -top-4 -left-4 w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center font-bold shadow-lg shadow-sky-500/30">01</div>
                    <div class="w-16 h-16 mx-auto rounded-full bg-sky-50 flex items-center justify-center mb-4 group-hover:bg-sky-100 transition-colors">
                        <i class="fa-solid fa-file-signature text-2xl text-sky-600"></i>
                    </div>
                    <h5 class="text-lg font-bold text-slate-800">Ajukan Permohonan</h5>
                </div>

                {{-- STEP 2 --}}
                <div class="relative bg-white rounded-2xl p-6 shadow-sm border border-slate-100 text-center hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div class="absolute -top-4 -left-4 w-10 h-10 rounded-full bg-amber-500 text-white flex items-center justify-center font-bold shadow-lg shadow-amber-500/30">02</div>
                    <div class="w-16 h-16 mx-auto rounded-full bg-amber-50 flex items-center justify-center mb-4 group-hover:bg-amber-100 transition-colors">
                        <i class="fa-solid fa-list-check text-2xl text-amber-600"></i>
                    </div>
                    <h5 class="text-lg font-bold text-slate-800">Verifikasi Data</h5>
                </div>

                {{-- STEP 3 --}}
                <div class="relative bg-white rounded-2xl p-6 shadow-sm border border-slate-100 text-center hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div class="absolute -top-4 -left-4 w-10 h-10 rounded-full bg-violet-500 text-white flex items-center justify-center font-bold shadow-lg shadow-violet-500/30">03</div>
                    <div class="w-16 h-16 mx-auto rounded-full bg-violet-50 flex items-center justify-center mb-4 group-hover:bg-violet-100 transition-colors">
                        <i class="fa-solid fa-gears text-2xl text-violet-600"></i>
                    </div>
                    <h5 class="text-lg font-bold text-slate-800">Proses Surat</h5>
                </div>

                {{-- STEP 4 --}}
                <div class="relative bg-white rounded-2xl p-6 shadow-sm border border-slate-100 text-center hover:shadow-xl hover:-translate-y-1 transition-all group">
                    <div class="absolute -top-4 -left-4 w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold shadow-lg shadow-emerald-500/30">04</div>
                    <div class="w-16 h-16 mx-auto rounded-full bg-emerald-50 flex items-center justify-center mb-4 group-hover:bg-emerald-100 transition-colors">
                        <i class="fa-solid fa-circle-check text-2xl text-emerald-600"></i>
                    </div>
                    <h5 class="text-lg font-bold text-slate-800">Surat Selesai</h5>
                </div>

            </div>
        </div>

    </div>
</section>