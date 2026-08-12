import re

with open('resources/views/admin/pengaduan/show.blade.php', 'r') as f:
    content = f.read()

# Fix layout grid
content = content.replace('<div class="flex flex-wrap -mx-3">', '<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">')
content = content.replace('<div class="w-full lg:w-2/3 px-3">', '<div class="lg:col-span-2 space-y-6">')
content = content.replace('<div class="w-full lg:w-1/3 px-3">', '<div class="lg:col-span-1 space-y-6">')

# Fix card classes
content = re.sub(r'<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0([^"]*)">', r'<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">', content)

# Fix Headers
content = re.sub(
    r'<div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header[^"]*">\s*<h5 class="mb-0 complaint-detail-card-title">\s*Informasi Pengaduan\s*</h5>\s*</div>',
    '<div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">\n <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-circle-info text-primary-600 mr-2"></i>Informasi Pengaduan</h3>\n </div>',
    content,
    flags=re.IGNORECASE|re.DOTALL
)

content = re.sub(
    r'<div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header[^"]*">\s*<h5 class="mb-0 complaint-detail-card-title">\s*Uraian Pengaduan\s*</h5>\s*</div>',
    '<div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">\n <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-file-lines text-sky-500 mr-2"></i>Uraian Pengaduan</h3>\n </div>',
    content,
    flags=re.IGNORECASE|re.DOTALL
)

content = re.sub(
    r'<div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header[^"]*">\s*<h5 class="mb-0 complaint-detail-card-title">\s*Foto Bukti\s*</h5>\s*</div>',
    '<div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">\n <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-image text-emerald-500 mr-2"></i>Foto Bukti</h3>\n </div>',
    content,
    flags=re.IGNORECASE|re.DOTALL
)

content = re.sub(
    r'<div class="px-6 py-4 border-b border-slate-200 bg-white border-0 complaint-detail-card-header complaint-detail-action-header">\s*<h5 class="mb-0 complaint-detail-card-title">\s*Aksi Pengaduan\s*</h5>\s*</div>',
    '<div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">\n <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-bolt text-amber-500 mr-2"></i>Aksi Pengaduan</h3>\n </div>',
    content,
    flags=re.IGNORECASE|re.DOTALL
)

# Fix back button
content = content.replace(
    '<a href="{{ route(\'admin.pengaduan.index\') }}"\n class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">',
    '<a href="{{ route(\'admin.pengaduan.index\') }}"\n class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer">'
)

# Fix form labels
content = content.replace('<label class="form-label">', '<label class="block text-sm font-semibold text-slate-700 mb-1.5">')

# Fix d-grid and w-100
content = content.replace('<div class="d-grid gap-3 mb-6">', '<div class="flex flex-col gap-3 mb-6">')
content = content.replace('w-100', 'w-full')
content = content.replace('px-5 py-3 text-base', 'px-4 py-2.5 text-sm')
content = content.replace('bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5', 'w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm')

# Add scale-95 to buttons
content = re.sub(
    r'(<button\s*class="[^"]*)(")',
    r'\1 active:scale-95 cursor-pointer\2',
    content
)

content = re.sub(
    r'(<a\s*href="{{ route\(\'admin\.pengaduan\.edit\',\$pengaduan\) }}"\s*class="[^"]*)(")',
    r'\1 active:scale-95 cursor-pointer\2',
    content
)

# Add mb-6 logic back in actions
content = content.replace('Edit Pengaduan\n\n </a>', 'Edit Pengaduan\n\n </a>\n\n <hr class="border-slate-100 my-6">')
# I'll just remove the mb-6 inside the a tag manually
content = content.replace('w-full mb-6 active:scale-95', 'w-full active:scale-95')

with open('resources/views/admin/pengaduan/show.blade.php', 'w') as f:
    f.write(content)
