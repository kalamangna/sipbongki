<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6 dark:bg-slate-900 dark:border-slate-800">
    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
        <h3 class="font-bold text-slate-800 dark:text-slate-100">Aksi & Status</h3>
    </div>
    <div class="p-6">
        @php
            $iconMap = [
                'Menunggu' => ['icon' => 'fa-hourglass-half', 'color' => 'amber'],
                'Diproses' => ['icon' => 'fa-arrow-rotate-right', 'color' => 'sky'],
                'Selesai'  => ['icon' => 'fa-circle-check', 'color' => 'emerald'],
                'Ditolak'  => ['icon' => 'fa-circle-xmark', 'color' => 'rose'],
            ];
            
            $statusData = $iconMap[$permohonanSurat->status] ?? ['icon' => 'fa-circle-question', 'color' => 'slate'];
            $color = $statusData['color'];
        @endphp

        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-{{ $color }}-50 text-{{ $color }}-600 mb-3 text-4xl dark:bg-{{ $color }}-950/60 dark:text-{{ $color }}-400">
                <i class="fa-solid {{ $statusData['icon'] }}"></i>
            </div>
            <h4 class="font-bold text-slate-900 text-lg dark:text-slate-100">{{ $permohonanSurat->status }}</h4>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mt-1 dark:text-slate-400">Status saat ini</p>
        </div>

        <hr class="border-slate-100 my-5 dark:border-slate-800">

        @if(in_array($permohonanSurat->status, ['Menunggu', 'Diproses']))
            <div class="mb-4 p-4 rounded-xl border {{ empty($permohonanSurat->penandatangan_id) ? 'bg-rose-50 border-rose-200 dark:bg-rose-950/30 dark:border-rose-900/60' : 'bg-slate-50 border-slate-200 dark:bg-slate-800/60 dark:border-slate-700' }}">
                <form action="{{ route('admin.permohonan-surat.update-penandatangan', $permohonanSurat) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="flex flex-col gap-2">
                        <label class="text-xs font-semibold {{ empty($permohonanSurat->penandatangan_id) ? 'text-rose-700 dark:text-rose-300' : 'text-slate-700 dark:text-slate-300' }}">
                            <i class="fa-solid fa-signature mr-1"></i> Pejabat Penandatangan
                        </label>
                        <select name="penandatangan_id" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary px-4 py-3 transition-colors shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" required onchange="this.form.submit()">
                            <option value="">-- Pilih Penandatangan --</option>
                            @foreach($penandatangans as $p)
                                <option value="{{ $p->id }}" {{ $permohonanSurat->penandatangan_id == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @if($permohonanSurat->penandatangan)
                            <div class="mt-1.5 px-3 py-2 bg-white/50 border border-slate-200/60 rounded-lg text-xs text-slate-600 dark:bg-slate-800/80 dark:border-slate-700 dark:text-slate-300">
                                Jabatan: <span class="font-bold text-slate-800 dark:text-slate-100">{{ $permohonanSurat->penandatangan->jabatan->nama ?? '-' }}</span>
                            </div>
                        @else
                            <p class="text-xs text-rose-600 font-medium mt-1 dark:text-rose-400">Pilih penandatangan untuk memproses surat.</p>
                        @endif
                    </div>
                </form>
            </div>
        @endif

        {{-- STATUS MENUNGGU --}}
        @if($permohonanSurat->status == 'Menunggu')
        <div class="flex flex-col gap-3">
            <form action="{{ route('admin.permohonan-surat.update-status', $permohonanSurat) }}" method="POST" class="w-full m-0">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="Diproses">
                <button type="submit" @if(empty($permohonanSurat->penandatangan_id)) disabled @endif class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all focus:outline-none active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer">
                    <i class="fa-solid fa-play-circle text-lg"></i> Proses Permohonan
                </button>
            </form>
            <form action="{{ route('admin.permohonan-surat.update-status', $permohonanSurat) }}" method="POST" class="w-full m-0">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="Ditolak">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-rose-200 text-rose-600 hover:bg-rose-50 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer dark:bg-rose-950/40 dark:border-rose-900/60 dark:text-rose-300 dark:hover:bg-rose-900/50" onclick="return confirm('Tolak permohonan ini?')">
                    <i class="fa-solid fa-circle-xmark text-lg"></i> Tolak Permohonan
                </button>
            </form>
        </div>
        @endif

        {{-- STATUS DIPROSES --}}
        @if($permohonanSurat->status == 'Diproses')
        <div class="flex flex-col gap-3">
            <a href="{{ empty($permohonanSurat->penandatangan_id) ? '#' : route('admin.permohonan-surat.print', $permohonanSurat) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-slate-600 text-white hover:bg-slate-700 shadow-sm transition-all focus:outline-none active:scale-95 {{ empty($permohonanSurat->penandatangan_id) ? 'opacity-50 cursor-not-allowed pointer-events-none' : 'cursor-pointer' }}">
                <i class="fa-solid fa-print text-lg"></i> Preview & Cetak Surat
            </a>
            <form action="{{ route('admin.permohonan-surat.update-status', $permohonanSurat) }}" method="POST" class="w-full m-0">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="Selesai">
                <button type="submit" @if(empty($permohonanSurat->penandatangan_id)) disabled @endif class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm transition-all focus:outline-none active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer" onclick="return confirm('Selesaikan permohonan ini?')">
                    <i class="fa-solid fa-circle-check text-lg"></i> Selesaikan Permohonan
                </button>
            </form>
        </div>
        @endif

        {{-- STATUS SELESAI --}}
        @if($permohonanSurat->status == 'Selesai')
        <div class="flex flex-col gap-3">
            <a href="{{ route('admin.permohonan-surat.print', $permohonanSurat) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-slate-600 text-white hover:bg-slate-700 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer">
                <i class="fa-solid fa-print text-lg"></i> Preview & Cetak Surat
            </a>
        </div>
        @endif

        {{-- ROLLBACK STATUS --}}
        @if(in_array($permohonanSurat->status, ['Diproses', 'Ditolak']))
        <div x-data="{ open: false }" class="mt-3">
            <button
                type="button"
                @click="open = true"
                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-semibold rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer dark:bg-slate-800/60 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-200"
            >
                <i class="fa-solid fa-rotate-left text-sm"></i>
                Kembalikan ke Menunggu
            </button>

            {{-- Modal konfirmasi rollback --}}
            <div
                x-show="open"
                x-transition.opacity
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
                @click.self="open = false"
            >
                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl w-full max-w-md border border-slate-200 dark:border-slate-800"
                >
                    <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex items-center gap-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-amber-50 dark:bg-amber-950/40 flex items-center justify-center text-amber-500">
                            <i class="fa-solid fa-rotate-left"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-slate-100">Kembalikan Status</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                {{ $permohonanSurat->status }} → Menunggu
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('admin.permohonan-surat.rollback-status', $permohonanSurat) }}" method="POST" class="p-5">
                        @csrf @method('PATCH')
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                            Pastikan ada alasan yang jelas untuk perubahan ini. Tindakan ini akan tercatat di riwayat permohonan.
                        </p>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                                Alasan rollback <span class="text-rose-500">*</span>
                            </label>
                            <textarea
                                name="alasan_rollback"
                                rows="3"
                                required
                                maxlength="500"
                                placeholder="Contoh: Data pemohon perlu diverifikasi ulang..."
                                class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-900 dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors shadow-sm resize-none"
                            ></textarea>
                        </div>
                        <div class="flex gap-2">
                            <button
                                type="button"
                                @click="open = false"
                                class="flex-1 px-4 py-2.5 text-sm font-semibold rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700 transition-all focus:outline-none cursor-pointer"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                class="flex-1 px-4 py-2.5 text-sm font-semibold rounded-xl bg-amber-500 text-white hover:bg-amber-600 shadow-sm transition-all focus:outline-none cursor-pointer"
                            >
                                <i class="fa-solid fa-rotate-left mr-1"></i> Kembalikan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        {{-- AKSI LAINNYA --}}
        <hr class="border-slate-100 my-5 dark:border-slate-800">
        <div class="flex flex-col gap-3">
            <a href="{{ route('admin.permohonan-surat.edit', $permohonanSurat) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-amber-500 text-white hover:bg-amber-600 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer">
                <i class="fa-solid fa-pen-to-square text-lg"></i> Edit Permohonan
            </a>
            <form action="{{ route('admin.permohonan-surat.destroy', $permohonanSurat) }}" method="POST" class="w-full m-0">
                @csrf @method('DELETE')
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-rose-200 text-rose-600 hover:bg-rose-50 shadow-sm transition-all focus:outline-none active:scale-95 cursor-pointer dark:bg-rose-950/40 dark:border-rose-900/60 dark:text-rose-300 dark:hover:bg-rose-900/50" onclick="return confirm('Yakin ingin menghapus permohonan ini?')">
                    <i class="fa-solid fa-trash text-lg"></i> Hapus Permohonan
                </button>
            </form>
        </div>
    </div>
</div>