@if(session('success'))

<div class="p-4 mb-6 rounded-xl bg-emerald-50 border border-emerald-100 text-sm text-emerald-800 flex justify-between items-center">

 <i class="fa-solid fa-circle-check-fill mr-2"></i>

 {{ session('success') }}

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all shadow-sm-close"
 onclick="this.parentElement.style.display='none'">
 </button>

</div>

@endif

@if(session('error'))

<div class="p-4 mb-6 rounded-xl bg-red-50 border border-red-100 text-sm text-red-800 flex justify-between items-center">

 <i class="fa-solid fa-exclamation-circle-fill mr-2"></i>

 {{ session('error') }}

 <button
 class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all shadow-sm-close"
 onclick="this.parentElement.style.display='none'">
 </button>

</div>

@endif