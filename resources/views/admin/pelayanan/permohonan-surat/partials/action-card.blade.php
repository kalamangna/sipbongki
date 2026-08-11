<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

 <div class="p-6">

 @php
 $icon = match($permohonanSurat->status) {
 'Menunggu' => 'bi-hourglass-split',
 'Diproses' => 'bi-arrow-repeat',
 'Selesai' => 'bi-check-circle-fill',
 'Ditolak' => 'bi-x-circle-fill',
 default => 'bi-question-circle',
 };
 @endphp

 <div class="text-center mb-6">

 <div class="mb-4">
 <i class="bi {{ $icon }} display-4 text-{{ $permohonanSurat->status_badge_class"></i>
 </div>

 </div>

 <hr class="my-4">

 {{-- =========================
 STATUS MENUNGGU
 ========================== --}}
 @if($permohonanSurat->status=='Menunggu')

 <div class="flex flex-column gap-3 items-center">

 <div class="w-100" style="max-width:220px;">
 <form
 action="{{ route('admin.permohonan-surat.update-status',$permohonanSurat) }}"
 method="POST">

 @csrf
 @method('PATCH')

 <input
 type="hidden"
 name="status"
 value="Diproses">

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm !px-3 !py-1.5 !text-xs w-100"
 onclick="return confirm('Proses permohonan ini?')">

 <i class="fa-solid fa-play-circle mr-2"></i>

 Proses Permohonan

 </button>

 </form>
 </div>

 <div class="w-100" style="max-width:220px;">
 <form
 action="{{ route('admin.permohonan-surat.update-status',$permohonanSurat) }}"
 method="POST">

 @csrf
 @method('PATCH')

 <input
 type="hidden"
 name="status"
 value="Ditolak">

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all shadow-sm-outline-danger !px-3 !py-1.5 !text-xs w-100"
 onclick="return confirm('Tolak permohonan ini?')">

 <i class="fa-solid fa-circle-xmark mr-2"></i>

 Tolak Permohonan

 </button>

 </form>
 </div>

 </div>

 @endif


 {{-- =========================
 STATUS DIPROSES
 ========================== --}}
 @if($permohonanSurat->status=='Diproses')

 <div class="flex flex-column gap-3 items-center">

 <div class="w-100" style="max-width:220px;">
 <a
 href="{{ route('admin.permohonan-surat.preview',$permohonanSurat) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs w-100">

 <i class="fa-solid fa-eye mr-2"></i>

 Preview Surat

 </a>
 </div>

 <div class="w-100" style="max-width:220px;">
 <a
 href="{{ route('admin.permohonan-surat.print',$permohonanSurat) }}"
 target="_blank"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600 !px-3 !py-1.5 !text-xs w-100">

 <i class="fa-solid fa-print mr-2"></i>

 Cetak Surat

 </a>
 </div>

 <div class="w-100" style="max-width:220px;">
 <form
 action="{{ route('admin.permohonan-surat.update-status',$permohonanSurat) }}"
 method="POST">

 @csrf
 @method('PATCH')

 <input
 type="hidden"
 name="status"
 value="Selesai">

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm !px-3 !py-1.5 !text-xs w-100"
 onclick="return confirm('Selesaikan permohonan ini?')">

 <i class="fa-solid fa-circle-check mr-2"></i>

 Selesaikan Permohonan

 </button>

 </form>
 </div>

 </div>

 @endif


 {{-- =========================
 STATUS SELESAI
 ========================== --}}
 @if($permohonanSurat->status=='Selesai')

 <div class="flex flex-column gap-3 items-center">

 <div class="w-100" style="max-width:220px;">
 <a
 href="{{ route('admin.permohonan-surat.preview',$permohonanSurat) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs w-100">

 <i class="fa-solid fa-eye mr-2"></i>

 Preview Surat

 </a>
 </div>

 <div class="w-100" style="max-width:220px;">
 <a
 href="{{ route('admin.permohonan-surat.print',$permohonanSurat) }}"
 target="_blank"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm !px-3 !py-1.5 !text-xs w-100">

 <i class="fa-solid fa-print mr-2"></i>

 Cetak Surat

 </a>
 </div>

 </div>

 @endif


 {{-- =========================
 EDIT
 ========================== --}}

 <hr>

 <div class="flex flex-column gap-3 items-center">
 <div class="w-100" style="max-width:220px;">
 <a
 href="{{ route('admin.permohonan-surat.edit',$permohonanSurat) }}"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-amber-500 text-white hover:bg-amber-600 shadow-sm !px-3 !py-1.5 !text-xs w-100">

 <i class="fa-solid fa-pen-to-square-square mr-2"></i>

 Edit Permohonan

 </a>
 </div>

 <div class="w-100" style="max-width:220px;">
 <form
 action="{{ route('admin.permohonan-surat.destroy', $permohonanSurat) }}"
 method="POST"
 class="mb-0">

 @csrf
 @method('DELETE')

 <button
 type="submit"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs w-100"
 onclick="return confirm('Yakin ingin menghapus permohonan ini?')">

 <i class="fa-solid fa-trash mr-2"></i>

 Hapus

 </button>

 </form>
 </div>
 </div>

 </div>

</div>