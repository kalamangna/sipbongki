import re

file_path = 'resources/views/admin/pelayanan/permohonan-surat/form.blade.php'

with open(file_path, 'r') as f:
    content = f.read()

# 1. Strip all error blocks completely since they are handled in create.blade.php and edit.blade.php
content = re.sub(r'@if \(\$errors->any\(\)\).*?@endif', '', content, flags=re.DOTALL)
# Strip @csrf
content = content.replace('@csrf\n', '')
content = content.replace('@csrf', '')

# 2. Fix Inputs
content = re.sub(r'class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p\.2\.5.*?"', 'class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"', content)
content = re.sub(r'class="form-control.*?"', 'class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"', content)
content = re.sub(r'class="form-select.*?"', 'class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"', content)

# 3. Fix Labels and Helpers
content = content.replace("class=\"form-label\"", "class=\"block text-sm font-semibold text-slate-700 mb-1.5\"")
content = content.replace("class=\"text-danger\"", "class=\"text-red-500\"")
content = content.replace("class=\"invalid-feedback\"", "class=\"text-red-500 text-xs mt-1\"")

# 4. Remove all flex-wrap wrappers completely, we will replace inner columns with proper grid layout
# This time we do it smartly by turning wrappers into grids
content = re.sub(r'<div class="flex flex-wrap -mx-3">', r'<div class="grid grid-cols-1 md:grid-cols-2 gap-6">', content)
content = re.sub(r'<div class="flex flex-wrap -mx-3 mb-4">', r'<div class="grid grid-cols-1 md:grid-cols-2 gap-6">', content)
content = re.sub(r'<div class="flex flex-wrap -mx-3" style="padding-left:5mm;">', r'<div class="grid grid-cols-1 md:grid-cols-2 gap-6">', content)

# 5. Fix column inner wrappers
# To not break grid, we strip the `px-3 mb-4` padding/margins, and map columns to col-span
content = re.sub(r'<div (id="[^"]*")?\s*class="w-full md:w-1/2 px-3 mb-4">', r'<div \1>', content)
content = re.sub(r'<div (id="[^"]*")?\s*class="w-full md:w-1/2 px-3">', r'<div \1>', content)
content = re.sub(r'<div (id="[^"]*")?\s*class="w-full md:w-full px-3 mb-4">', r'<div \1 class="md:col-span-2">', content)
content = re.sub(r'<div (id="[^"]*")?\s*class="w-full md:w-full px-3">', r'<div \1 class="md:col-span-2">', content)
content = re.sub(r'<div (id="[^"]*")?\s*class="w-full md:w-1/3 px-3 mb-4">', r'<div \1>', content)
content = re.sub(r'<div (id="[^"]*")?\s*class="w-full md:w-1/4 px-3 mb-4">', r'<div \1>', content)
content = re.sub(r'<div (id="[^"]*")?\s*class="w-full px-3 mb-4">', r'<div \1 class="md:col-span-2">', content)

content = re.sub(r'<div (id="[^"]*")?\s*class="col-md-8 mb-4">', r'<div \1 class="md:col-span-2">', content)
content = re.sub(r'<div (id="[^"]*")?\s*class="col-md-8 mb-5">', r'<div \1 class="md:col-span-2">', content)
content = re.sub(r'<div (id="[^"]*")?\s*class="col-md-6 mb-4">', r'<div \1>', content)
content = re.sub(r'<div (id="[^"]*")?\s*class="col-md-12 mb-4">', r'<div \1 class="md:col-span-2">', content)

# 6. Fix standalone divs for Keperluan and Catatan
content = re.sub(r'<div class="mb-4">\s*<label', r'<div class="md:col-span-2 mb-4">\n<label', content)
content = re.sub(r'<div class="mb-6">\s*<label', r'<div class="md:col-span-2 mb-6">\n<label', content)

# 7. Fix Cards
# Find all occurrences of bg-white rounded-2xl... and make them premium tailwind
content = re.sub(r'class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0([^"]*)"', r'class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden mb-6 mt-6\1"', content)

# Card Headers
content = re.sub(r'class="px-6 py-4 border-b border-slate-200 bg-light"', r'class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50"', content)
content = re.sub(r'<strong>(.*?)</strong>', r'<h3 class="font-bold text-slate-800 text-base mb-0">\1</h3>', content)

# 8. Remove duplicate save buttons
content = re.sub(r'<div class="flex justify-end">.*?Kembali.*?Simpan.*?</div>', '', content, flags=re.DOTALL)

# Wrap Pemohon & Jenis Surat in a card!
pemohon_start = '<div class="grid grid-cols-1 md:grid-cols-2 gap-6">'
pemohon_end_and_usaha = '</div>\n {{-- =========================================================\n| DATA USAHA'

pemohon_wrapper = """<div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden mb-6">
 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0">Informasi Utama</h3>
 </div>
 <div class="p-6">
 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">"""
content = content.replace(pemohon_start, pemohon_wrapper, 1)

pemohon_closing = """ </div>
 </div>
</div>
 {{-- =========================================================
| DATA USAHA"""
content = content.replace(pemohon_end_and_usaha, pemohon_closing)

# Wrap bottom fields (Tanggal Permohonan, Penandatangan, Keperluan, Catatan)
# Find the end of domisili fields
end_domisili = """ </div>
 
 </div>

</div>


<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 {{-- Tanggal Permohonan --}}"""

wrapper_tambahan = """ </div>
 
 </div>

</div>

<div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden mb-6">
 <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
 <h3 class="font-bold text-slate-800 text-base mb-0">Informasi Tambahan</h3>
 </div>
 <div class="p-6">
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

 {{-- Tanggal Permohonan --}}"""

content = content.replace(end_domisili, wrapper_tambahan)

# Close the Informasi Tambahan card before script
content = content.replace('<script>', '</div>\n </div>\n</div>\n\n<script>')

with open(file_path, 'w') as f:
    f.write(content)
