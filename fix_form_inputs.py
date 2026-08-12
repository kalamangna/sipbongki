import re

file_path = 'resources/views/admin/pelayanan/permohonan-surat/form.blade.php'
with open(file_path, 'r') as f:
    content = f.read()

# Fix all inputs and selects that match the old pattern
old_pattern = r'class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2\.5[^"]*"'
new_class = 'class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm"'

content = re.sub(old_pattern, new_class, content)

# Remove any @error('...') is-invalid @enderror leftovers inside class attributes if they exist
content = re.sub(r' @error\([^)]+\) is-invalid @enderror', '', content)

# Add icons to card headers
content = content.replace(
    '<h3 class="font-bold text-slate-800 text-base mb-0">Informasi Utama</h3>',
    '<h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-file-lines text-primary-600 mr-2"></i>Informasi Utama</h3>'
)

content = content.replace(
    '<h3 class="font-bold text-slate-800 text-base mb-0">Data Usaha</h3>',
    '<h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-store text-emerald-500 mr-2"></i>Data Usaha</h3>'
)

content = content.replace(
    '<h3 class="font-bold text-slate-800 text-base mb-0">Data Almarhum / Almarhumah</h3>',
    '<h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-user-large-slash text-slate-500 mr-2"></i>Data Almarhum / Almarhumah</h3>'
)

content = content.replace(
    '<h3 class="font-bold text-slate-800 text-base mb-0">Waktu & Tempat Kematian</h3>',
    '<h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-clock text-amber-500 mr-2"></i>Waktu & Tempat Kematian</h3>'
)

content = content.replace(
    '<h3 class="font-bold text-slate-800 text-base mb-0">Data Pelapor</h3>',
    '<h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-user-check text-sky-500 mr-2"></i>Data Pelapor</h3>'
)

content = content.replace(
    '<h3 class="font-bold text-slate-800 text-base mb-0">\n Data Dokumen Orang Yang Sama\n </h3>',
    '<h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-users text-indigo-500 mr-2"></i>Data Dokumen Orang Yang Sama</h3>'
)

content = content.replace(
    '<h3 class="font-bold text-slate-800 text-base mb-0">Data Domisili</h3>',
    '<h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-house-chimney text-rose-500 mr-2"></i>Data Domisili</h3>'
)

content = content.replace(
    '<h3 class="font-bold text-slate-800 text-base mb-0">Informasi Tambahan</h3>',
    '<h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-circle-info text-teal-500 mr-2"></i>Informasi Tambahan</h3>'
)

# Fix double mb-6 mt-6 mb-4 on Data Usaha wrapper
content = content.replace('overflow-hidden mb-6 mt-6 mb-4"', 'overflow-hidden mb-6 mt-6"')

with open(file_path, 'w') as f:
    f.write(content)
