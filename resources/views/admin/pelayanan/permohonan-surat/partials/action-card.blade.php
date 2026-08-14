<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="font-bold text-slate-800">Aksi & Status</h3>
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
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-{{ $color }}-50 text-{{ $color }}-600 mb-3 text-4xl">
                <i class="fa-solid {{ $statusData['icon'] }}"></i>
            </div>
            <h4 class="font-bold text-slate-900 text-lg">{{ $permohonanSurat->status }}</h4>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mt-1">Status saat ini</p>
        </div>

        <hr class="border-slate-100 my-5">

        @if(in_array($permohonanSurat->status, ['Menunggu', 'Diproses']))
            <div class="mb-4 p-4 rounded-xl border {{ empty($permohonanSurat->penandatangan_id) ? 'bg-rose-50 border-rose-200' : 'bg-slate-50 border-slate-200' }}">
                <form action="{{ route('admin.permohonan-surat.update-penandatangan', $permohonanSurat) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="flex flex-col gap-2">
                        <label class="text-xs font-semibold {{ empty($permohonanSurat->penandatangan_id) ? 'text-rose-700' : 'text-slate-700' }}">
                            <i class="fa-solid fa-signature mr-1"></i> Pejabat Penandatangan
                        </label>
                        <select name="penandatangan_id" class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm" required onchange="this.form.submit()">
                            <option value="">-- Pilih Penandatangan --</option>
                            @foreach($penandatangans as $p)
                                <option value="{{ $p->id }}" {{ $permohonanSurat->penandatangan_id == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @if($permohonanSurat->penandatangan)
                            <div class="mt-1.5 px-3 py-2 bg-white/50 border border-slate-200/60 rounded-lg text-xs text-slate-600">
                                Jabatan: <span class="font-bold text-slate-800">{{ $permohonanSurat->penandatangan->jabatan->nama ?? '-' }}</span>
                            </div>
                        @else
                            <p class="text-xs text-rose-600 font-medium mt-1">Pilih penandatangan untuk memproses surat.</p>
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
                <button type="submit" @if(empty($permohonanSurat->penandatangan_id)) disabled @endif class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-sm transition-all focus:outline-none active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fa-solid fa-play-circle text-lg"></i> Proses Permohonan
                </button>
            </form>
            <form action="{{ route('admin.permohonan-surat.update-status', $permohonanSurat) }}" method="POST" class="w-full m-0">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="Ditolak">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-rose-200 text-rose-600 hover:bg-rose-50 shadow-sm transition-all focus:outline-none active:scale-95" onclick="return confirm('Tolak permohonan ini?')">
                    <i class="fa-solid fa-circle-xmark text-lg"></i> Tolak Permohonan
                </button>
            </form>
        </div>
        @endif

        {{-- STATUS DIPROSES --}}
        @if($permohonanSurat->status == 'Diproses')
        <div class="flex flex-col gap-3">
            <a href="{{ empty($permohonanSurat->penandatangan_id) ? '#' : route('admin.permohonan-surat.print', $permohonanSurat) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-slate-600 text-white hover:bg-slate-700 shadow-sm transition-all focus:outline-none active:scale-95 {{ empty($permohonanSurat->penandatangan_id) ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                <i class="fa-solid fa-print text-lg"></i> Preview & Cetak Surat
            </a>
            <form action="{{ route('admin.permohonan-surat.update-status', $permohonanSurat) }}" method="POST" class="w-full m-0">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="Selesai">
                <button type="submit" @if(empty($permohonanSurat->penandatangan_id)) disabled @endif class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm transition-all focus:outline-none active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed" onclick="return confirm('Selesaikan permohonan ini?')">
                    <i class="fa-solid fa-circle-check text-lg"></i> Selesaikan Permohonan
                </button>
            </form>
        </div>
        @endif

        {{-- STATUS SELESAI --}}
        @if($permohonanSurat->status == 'Selesai')
        <div class="flex flex-col gap-3">
            <a href="{{ route('admin.permohonan-surat.print', $permohonanSurat) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-slate-600 text-white hover:bg-slate-700 shadow-sm transition-all focus:outline-none active:scale-95">
                <i class="fa-solid fa-print text-lg"></i> Preview & Cetak Surat
            </a>
        </div>
        @endif

        {{-- AKSI LAINNYA --}}
        <hr class="border-slate-100 my-5">
        <div class="flex flex-col gap-3">
            <a href="{{ route('admin.permohonan-surat.edit', $permohonanSurat) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-amber-500 text-white hover:bg-amber-600 shadow-sm transition-all focus:outline-none active:scale-95">
                <i class="fa-solid fa-pen-to-square text-lg"></i> Edit Permohonan
            </a>
            <form action="{{ route('admin.permohonan-surat.destroy', $permohonanSurat) }}" method="POST" class="w-full m-0">
                @csrf @method('DELETE')
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl bg-white border border-rose-200 text-rose-600 hover:bg-rose-50 shadow-sm transition-all focus:outline-none active:scale-95" onclick="return confirm('Yakin ingin menghapus permohonan ini?')">
                    <i class="fa-solid fa-trash text-lg"></i> Hapus Permohonan
                </button>
            </form>
        </div>
    </div>
</div>