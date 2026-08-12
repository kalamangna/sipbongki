import re

file_path = 'resources/views/admin/pelayanan/permohonan-surat/form.blade.php'
with open(file_path, 'r') as f:
    content = f.read()

# Top of form: Add the grid wrapper and KIRI column
content = re.sub(
    r'<div class="bg-white rounded-3xl ring-1',
    r'<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">\n\n    {{-- KIRI: Informasi Utama & Dinamis --}}\n    <div class="space-y-6">\n\n        <div class="bg-white rounded-3xl ring-1',
    content,
    count=1
)

# Find the start of Informasi Tambahan to close KIRI and open KANAN
tambahan_marker = '<div class="bg-white rounded-3xl ring-1 ring-slate-200/60 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden">\n <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">\n <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-circle-info text-teal-500 mr-2"></i>Informasi Tambahan</h3>'

kanan_marker = '    </div>\n\n    {{-- KANAN: Informasi Tambahan --}}\n    <div class="space-y-6">\n        ' + tambahan_marker
content = content.replace(tambahan_marker, kanan_marker)

# Find the end of the form (before <script>) and close KANAN and the main Grid
script_marker = '<script>'
end_marker = '    </div>\n</div>\n\n<script>'
content = content.replace(script_marker, end_marker)

with open(file_path, 'w') as f:
    f.write(content)
