<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mt-6">

 <div class="p-6">

 <div class="flex justify-end">

 @if($permohonanSurat->status=='Selesai')

 <button
 type="button"
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm"
 disabled>

 <i class="fa-solid fa-print"></i>

 Cetak Surat

 </button>

 @endif

 </div>

 </div>

</div>