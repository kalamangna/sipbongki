@if(session('success'))

<div class="p-4 mb-4 text-sm text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 p-4 mb-4 text-sm rounded-xl border-dismissible fade show shadow-sm">

 <i class="fa-solid fa-circle-check-fill mr-2"></i>

 {{ session('success') }}

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all shadow-sm-close"
 data-bs-dismiss="p-4 mb-4 text-sm rounded-xl border">
 </button>

</div>

@endif

@if(session('error'))

<div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200 p-4 mb-4 text-sm rounded-xl border-dismissible fade show shadow-sm">

 <i class="fa-solid fa-exclamation-circle-fill mr-2"></i>

 {{ session('error') }}

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all shadow-sm-close"
 data-bs-dismiss="p-4 mb-4 text-sm rounded-xl border">
 </button>

</div>

@endif