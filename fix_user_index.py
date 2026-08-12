import re

with open('resources/views/admin/pengaturan/user/index.blade.php', 'r') as f:
    content = f.read()

# Fix Title
content = re.sub(
    r'(<div class="flex justify-between items-center mb-6">\s*<div>\s*)<p class="text-slate-500 mb-0">',
    r'\1<h3 class="text-2xl font-bold text-slate-800 mb-1">Manajemen Pengguna</h3>\n <p class="text-slate-500 mb-0">',
    content
)

# Fix backslashes in classes
content = content.replace(r'class=\"text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200 px-4 py-3 font-medium text-slate-700\"', 'class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200"')
content = content.replace(r'class=\"text-center px-4 py-3 border-b border-slate-100\"', 'class="text-center px-4 py-3 border-b border-slate-100"')
content = content.replace(r'colspan="7" class=\"text-center py-8 px-4 py-3 border-b border-slate-100\"', 'colspan="6" class="text-center py-8 px-4 py-3 border-b border-slate-100"')

# Fix card
content = content.replace('<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm">', '<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">')

# Fix button
content = re.sub(r'(<a[^>]*Pengguna\s*</a>)', lambda m: m.group(1).replace('class="', 'class="active:scale-95 cursor-pointer '), content)

# Fix reset button
content = re.sub(r'(<a[^>]*Reset\s*</a>)', lambda m: m.group(1).replace('class="', 'class="active:scale-95 cursor-pointer '), content)

# Fix search button
content = re.sub(r'(<button[^>]*Cari\s*</button>)', lambda m: m.group(1).replace('class="', 'class="active:scale-95 cursor-pointer '), content)

# Fix action buttons
content = re.sub(r'(<a[^>]*title="Edit"[^>]*>)', lambda m: m.group(1).replace('class="', 'class="active:scale-95 cursor-pointer '), content)
content = re.sub(r'(<button[^>]*title="Hapus"[^>]*>)', lambda m: m.group(1).replace('class="', 'class="active:scale-95 cursor-pointer '), content)

with open('resources/views/admin/pengaturan/user/index.blade.php', 'w') as f:
    f.write(content)
