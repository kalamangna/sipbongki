import re

with open('resources/views/admin/pengaduan/edit.blade.php', 'r') as f:
    content = f.read()

# Fix Title
content = content.replace('<h3 class="font-bold mb-1">', '<h3 class="text-2xl font-bold text-slate-800 mb-1">')

# Fix back button
content = content.replace(
    '<a href="{{ route(\'admin.pengaduan.index\') }}"\n class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">',
    '<a href="{{ route(\'admin.pengaduan.index\') }}"\n class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer">'
)

# Fix Card
content = content.replace('<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">', '<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">\n\n <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">\n <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-pen-to-square text-primary-600 mr-2"></i>Form Edit Pengaduan</h3>\n </div>')

# Fix Labels
content = content.replace('<label class="form-label">', '<label class="block text-sm font-semibold text-slate-700 mb-1.5">')

# Fix Inputs
content = content.replace('bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5', 'w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm')

# Button
content = content.replace('shadow-sm">\n <i class="fa-solid fa-save mr-2"></i>\n Simpan Perubahan\n </button>', 'shadow-sm active:scale-95 cursor-pointer">\n <i class="fa-solid fa-circle-check"></i>\n Simpan Perubahan\n </button>')

# Form footer wrapper
content = re.sub(
    r'(<button type="submit" class="inline-flex items-center[^>]+>\s*<i class="fa-solid fa-circle-check"></i>\s*Simpan Perubahan\s*</button>)',
    r'<div class="flex justify-end pt-4 border-t border-slate-100 mt-6">\n \1\n </div>',
    content
)

with open('resources/views/admin/pengaduan/edit.blade.php', 'w') as f:
    f.write(content)
