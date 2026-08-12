import re

with open('resources/views/admin/website/pengaturan/edit.blade.php', 'r') as f:
    content = f.read()

# Header
content = re.sub(r'(<div>\s*)<p class="text-slate-500 mb-0">', r'\1<h3 class="text-2xl font-bold text-slate-800 mb-1">Edit Pengaturan</h3>\n <p class="text-slate-500 mb-0">', content)

# Back Button
content = content.replace(
    '<a href="{{ route(\'admin.website.pengaturan.index\') }}"\n class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-slate-500 text-white hover:bg-slate-600">',
    '<a href="{{ route(\'admin.website.pengaturan.index\') }}"\n class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer">'
)

# Main Card
content = content.replace('<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">', '<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">')

# Inner Cards
content = content.replace('<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">', '<div class="border border-slate-100 rounded-xl overflow-hidden mb-6">')

# Inner Headers
content = re.sub(r'<div class="px-6 py-4 border-b border-slate-200 bg-[a-z]+-100 text-[a-z]+-700( text-white)?">', r'<div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">', content)

# Inner H5 titles
content = re.sub(r'<h5 class="mb-0">\s*<i class="fa-solid ([^"]+)(?: mr-2)?"></i>\s*([^<]+)\s*</h5>', r'<h3 class="font-bold text-slate-800 text-base mb-0"><i class="fa-solid \1 text-primary-600 mr-2"></i> \2</h3>', content)

# Labels
content = content.replace('<label class="form-label font-semibold">', '<label class="block text-sm font-semibold text-slate-700 mb-1.5">')

# Layout Grids
content = content.replace('<div class="flex flex-wrap -mx-3">', '<div class="grid grid-cols-1 md:grid-cols-2 gap-6">')
content = content.replace('<div class="w-full md:w-1/2 px-3">', '<div class="md:col-span-1">')
content = content.replace('<div class="w-full md:w-full px-3">', '<div class="md:col-span-2">')

# Form Buttons
content = re.sub(r'(<button type="submit" class="[^"]*)(")', r'\1 active:scale-95 cursor-pointer\2', content)

with open('resources/views/admin/website/pengaturan/edit.blade.php', 'w') as f:
    f.write(content)
