<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6 dark:bg-slate-900 dark:border-slate-800">
    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
        <h3 class="font-bold text-slate-800 dark:text-slate-100">Riwayat Pelayanan</h3>
    </div>
    <div class="p-6">
        <div class="relative space-y-6 before:absolute before:inset-0 before:ml-[1.4rem] before:-translate-x-px md:before:ml-[1.4rem] md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent dark:before:via-slate-700">
            
            {{-- Permohonan Dibuat --}}
            <div class="relative flex items-center gap-4">
                <div class="w-11 h-11 rounded-full bg-primary-50 border-4 border-white flex items-center justify-center text-primary-600 shadow-sm z-10 shrink-0 text-lg dark:bg-primary-950/60 dark:border-slate-900 dark:text-primary-400">
                    <i class="fa-solid fa-file-circle-plus"></i>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-slate-900 text-base mb-0.5 dark:text-slate-100">Permohonan Dibuat</p>
                    <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">{{ $permohonanSurat->created_at->translatedFormat('d F Y H:i') }}</p>
                    @php
                        $creatorLabel = 'Warga';
                        if ($permohonanSurat->operator) {
                            $role = strtolower($permohonanSurat->operator->role ?? 'operator');
                            $creatorLabel = $role === 'admin' ? 'Admin' : 'Operator';
                        }
                    @endphp
                    <p class="text-xs text-slate-500 mb-0 dark:text-slate-400">Data permohonan berhasil dibuat oleh <span class="font-semibold dark:text-slate-300">{{ $creatorLabel }}</span>.</p>
                </div>
            </div>

            {{-- Diproses --}}
            @if(in_array($permohonanSurat->status, ['Diproses', 'Selesai']))
            <div class="relative flex items-center gap-4">
                <div class="w-11 h-11 rounded-full bg-sky-50 border-4 border-white flex items-center justify-center text-sky-600 shadow-sm z-10 shrink-0 text-lg dark:bg-sky-950/60 dark:border-slate-900 dark:text-sky-400">
                    <i class="fa-solid fa-arrow-rotate-right"></i>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-slate-900 text-base mb-0.5 dark:text-slate-100">Permohonan Diproses</p>
                    <p class="text-xs text-slate-500 mb-0 dark:text-slate-400">Sedang diproses oleh petugas pelayanan.</p>
                </div>
            </div>
            @endif

            {{-- Ditolak --}}
            @if($permohonanSurat->status == 'Ditolak')
            <div class="relative flex items-center gap-4">
                <div class="w-11 h-11 rounded-full bg-rose-50 border-4 border-white flex items-center justify-center text-rose-600 shadow-sm z-10 shrink-0 text-lg dark:bg-rose-950/60 dark:border-slate-900 dark:text-rose-400">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-rose-700 text-base mb-0.5 dark:text-rose-400">Permohonan Ditolak</p>
                    <p class="text-xs text-slate-500 mb-0 dark:text-slate-400">Permohonan tidak dapat diproses.</p>
                </div>
            </div>
            @endif

            {{-- Selesai --}}
            @if($permohonanSurat->status == 'Selesai')
            <div class="relative flex items-center gap-4">
                <div class="w-11 h-11 rounded-full bg-emerald-50 border-4 border-white flex items-center justify-center text-emerald-600 shadow-sm z-10 shrink-0 text-lg dark:bg-emerald-950/60 dark:border-slate-900 dark:text-emerald-400">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-emerald-700 text-base mb-0.5 dark:text-emerald-400">Surat Selesai</p>
                    @if($permohonanSurat->tanggal_selesai)
                        <p class="text-xs font-semibold text-slate-500 mb-1 dark:text-slate-400">{{ \Carbon\Carbon::parse($permohonanSurat->tanggal_selesai)->translatedFormat('d F Y H:i') }}</p>
                    @endif
                    <p class="text-xs text-slate-500 mb-0 dark:text-slate-400">Surat telah selesai diproses dan siap dicetak.</p>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>