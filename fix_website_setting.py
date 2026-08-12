import re

with open('resources/views/admin/website/pengaturan/index.blade.php', 'r') as f:
    content = f.read()

# Fix layout grid
content = content.replace('<div class="flex flex-wrap -mx-3">', '<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">')
content = content.replace('<div class="w-full lg:w-1/3 px-3">', '<div class="lg:col-span-1 flex flex-col">')
content = content.replace('<div class="w-full lg:w-2/3 px-3">', '<div class="lg:col-span-2 flex flex-col">')
content = content.replace('<div class="w-full px-3">', '<div class="lg:col-span-3 flex flex-col">')
content = content.replace('<div class="flex flex-wrap -mx-3">', '<div class="grid grid-cols-1 md:grid-cols-3 gap-4">') # For inner flex wraps like social media
content = content.replace('<div class="w-full md:w-1/3 px-3 mb-4">', '<div class="flex flex-col">')


# Fix cards
content = re.sub(r'<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0([^"]*)">', r'<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex-1">', content)
content = re.sub(r'<div class="p-6 flex flex-column">', r'<div class="p-6 flex flex-col h-full">', content)

# Header Title
content = re.sub(r'<div>\s*<p class="text-slate-500 mb-0">', r'<div>\n <h3 class="text-2xl font-bold text-slate-800 mb-1">Pengaturan Website</h3>\n <p class="text-slate-500 mb-0">', content)

# Card Headers inside body
content = re.sub(r'<h5 class="font-bold text-center mb-6">\s*Logo Website\s*</h5>', r'<h3 class="font-bold text-slate-800 text-base mb-6 text-center">Logo Website</h3>', content)
content = re.sub(r'<h5 class="font-bold mb-6">\s*Informasi Website\s*</h5>', r'<h3 class="font-bold text-slate-800 text-base mb-6">Informasi Website</h3>', content)
content = re.sub(r'<h5 class="font-bold mb-6">\s*Sosial Media\s*</h5>', r'<h3 class="font-bold text-slate-800 text-base mb-6">Sosial Media</h3>', content)
content = re.sub(r'<h5 class="font-bold mb-4">\s*Deskripsi Website\s*</h5>', r'<h3 class="font-bold text-slate-800 text-base mb-4">Deskripsi Website</h3>', content)

# Buttons
content = re.sub(r'active:scale-95\s*', '', content) # clean up if exists
content = re.sub(r'(<a[^>]*Edit Pengaturan[^>]*class="[^"]*)(")', r'\1 active:scale-95 cursor-pointer\2', content)

with open('resources/views/admin/website/pengaturan/index.blade.php', 'w') as f:
    f.write(content)
