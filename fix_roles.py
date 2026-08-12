import re

file_path = 'resources/views/admin/pengaturan/user/roles.blade.php'

with open(file_path, 'r') as f:
    content = f.read()

# Fix Title
content = re.sub(r'<div>\s*<p class="text-slate-500 mb-0">', r'<div>\n <h3 class="text-2xl font-bold text-slate-800 mb-1">Daftar Hak Akses</h3>\n <p class="text-slate-500 mb-0">', content)

# Fix Main Card
content = content.replace('<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">', '<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">')

# Fix Grid
content = content.replace('<div class="flex flex-wrap -mx-3 mt-6">', '<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">')

# Remove unnecessary column wrappers
content = re.sub(r'<div class="w-full md:w-1/2 px-3 mb-4">\s*<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 h-100 p-3">', r'<div class="border border-slate-100 rounded-xl overflow-hidden bg-slate-50/50 p-4">', content)

# Fix H6 to H3
content = re.sub(r'<h6 class="mb-2">([^<]+)</h6>', r'<h3 class="font-bold text-slate-800 text-base mb-2">\1</h3>', content)

with open(file_path, 'w') as f:
    f.write(content)
