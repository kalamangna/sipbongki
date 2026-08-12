import re

files = [
    'resources/views/admin/pengaturan/user/create.blade.php',
    'resources/views/admin/pengaturan/user/edit.blade.php'
]

for file in files:
    with open(file, 'r') as f:
        content = f.read()

    # Title
    content = re.sub(r'<h4 class="mb-1">([^<]+)</h4>', r'<h3 class="text-2xl font-bold text-slate-800 mb-1">\1</h3>', content)

    # Back button top
    content = re.sub(
        r'<a href="\{\{ route\(\'admin\.user\.index\'\) \}\}" class="inline-flex[^"]*"(?:>|\s*>)',
        r'<a href="{{ route(\'admin.user.index\') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer">',
        content
    )

    # Card
    content = content.replace('<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">', '<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">\n <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">\n <h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid fa-user-pen text-primary-600 mr-2"></i>Formulir Data</h3>\n </div>')

    # Grid
    content = re.sub(r'<div class="flex flex-wrap -mx-3 gap-4">', r'<div class="grid grid-cols-1 md:grid-cols-2 gap-6">', content)
    content = re.sub(r'<div class="w-full md:w-1/2 px-3">', r'<div>', content)

    # Labels
    content = content.replace('<label class="form-label">', '<label class="block text-sm font-semibold text-slate-700 mb-1.5">')

    # Inputs
    content = content.replace('bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5', 'w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 px-4 py-3 transition-colors shadow-sm')

    # Footer Buttons
    footer_block = r'<div class="mt-6">\s*<button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">Simpan</button>\s*<a href="\{\{ route\(\'admin\.user\.index\'\) \}\}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">Batal</a>\s*</div>'
    new_footer = r'<div class="flex justify-end gap-3 pt-6 border-t border-slate-100 mt-8">\n <a href="{{ route(\'admin.user.index\') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer">Batal</a>\n <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm active:scale-95 cursor-pointer"><i class="fa-solid fa-save mr-1"></i>Simpan</button>\n </div>'
    
    content = re.sub(footer_block, new_footer, content)

    with open(file, 'w') as f:
        f.write(content)
