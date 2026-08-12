import re

file_path = 'resources/views/admin/pelayanan/permohonan-surat/form.blade.php'
with open(file_path, 'r') as f:
    content = f.read()

# Replace old inputs that got missed
content = re.sub(r'class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p\.2\.5.*?"', 'class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"', content)

# Specific exact string replacements for missed inputs
content = content.replace('class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error(\'penandatangan_id\') is-invalid @enderror"', 'class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"')
content = content.replace('class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error(\'tanggal_permohonan\') is-invalid @enderror"', 'class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"')
content = content.replace('class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error(\'keperluan\') is-invalid @enderror"', 'class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"')
content = content.replace('class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 @error(\'catatan\') is-invalid @enderror"', 'class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"')

# Fix the broken grid structure at the bottom
# Look at the end of Domisili:
old_end = """ </div>
 
 </div>

</div>

<div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden mb-6">
 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0">Informasi Tambahan</h3>
 </div>
 <div class="p-6">
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 {{-- Tanggal Permohonan --}}"""

new_end = """ </div>
 </div>
</div>

<div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden mb-6">
 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0">Informasi Tambahan</h3>
 </div>
 <div class="p-6">
 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 {{-- Tanggal Permohonan --}}"""
content = content.replace(old_end, new_end)

# Find the end of Penandatangan, where the `</div>` prematurely closes the grid
broken_grid_end = """ @enderror

 </div>

</div>

{{-- Keperluan --}}
<div class="md:col-span-2 mb-4">
<label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Keperluan"""

fixed_grid_end = """ @enderror

 </div>

{{-- Keperluan --}}
<div class="md:col-span-2">
<label class="block text-sm font-semibold text-slate-700 mb-1.5">
 Keperluan"""
content = content.replace(broken_grid_end, fixed_grid_end)

# Also fix the catatan wrapper
content = content.replace('<div class="md:col-span-2 mb-6">\n<label class="block text-sm font-semibold text-slate-700 mb-1.5">\n Catatan', '<div class="md:col-span-2">\n<label class="block text-sm font-semibold text-slate-700 mb-1.5">\n Catatan')

with open(file_path, 'w') as f:
    f.write(content)
