import os

filepath = "/Users/abedzul/Desktop/htdocs/sipbongki/resources/views/admin/pengaduan/index.blade.php"
with open(filepath, 'r') as f:
    content = f.read()

# Fix Header Section
old_header = """ <div class="flex justify-between items-center mb-6">

 <div>

 
 <p class="text-slate-500 mb-0">
 Daftar seluruh pengaduan yang dikirim oleh masyarakat Kelurahan Bongki.
 </p>

 </div>

 </div>"""

new_header = """    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Data Pengaduan</h2>
            <p class="text-sm text-slate-500 mt-1">Daftar seluruh pengaduan yang dikirim oleh masyarakat Kelurahan Bongki.</p>
        </div>
    </div>"""

content = content.replace(old_header, new_header)

# Fix wrapper
content = content.replace('<div class="p-0">', '')
content = content.replace('<div class="overflow-x-auto w-full">', '<div class="overflow-x-auto">')
# the extra closing div for p-0 is near the end, we'll fix it by just finding and replacing the exact structure

# Fix table header
old_thead = """ <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">"""
new_thead = """ <thead class="text-xs font-semibold text-slate-500 uppercase bg-slate-50/50">"""
content = content.replace(old_thead, new_thead)

# Fix th borders
content = content.replace('class="px-4 py-3 font-medium text-slate-700"', 'class="px-6 py-4 border-b border-slate-100"')
content = content.replace('class="text-center px-4 py-3 font-medium text-slate-700"', 'class="px-6 py-4 border-b border-slate-100 text-center"')
content = content.replace('width="60"', 'width="50"')
content = content.replace('width="120"', 'width="100"')

# Fix tbody and td
content = content.replace('<tbody>', '<tbody class="divide-y divide-slate-100">')
content = content.replace('<tr>\n\n <td class="px-4 py-3 border-b border-slate-100">', '<tr class="hover:bg-slate-50/80 transition-colors">\n <td class="px-6 py-4 text-center font-medium">')
content = content.replace('<td class="px-4 py-3 border-b border-slate-100">', '<td class="px-6 py-4">')
content = content.replace('<td class="text-center px-4 py-3 border-b border-slate-100">', '<td class="px-6 py-4 text-center">')

# Fix status badge
content = content.replace('<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">\n Baru\n </span>', '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-100 text-rose-700 tracking-wide">Baru</span>')
content = content.replace('<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">\n Diproses\n </span>', '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700 tracking-wide">Diproses</span>')
content = content.replace('<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">\n Selesai\n </span>', '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 tracking-wide">Selesai</span>')

# Fix action buttons
old_actions = """ <div class="flex justify-center gap-2">

 <a
 href="{{ route('admin.pengaduan.show',$pengaduan) }}"
 class="inline-flex items-center justify-center gap-2 px-3 py-1.5 text-xs font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm active:scale-95"
 title="Detail">

 <i class="fa-solid fa-eye"></i>

 </a>

 {{-- Edit action removed per request --}}

 <form
 action="{{ route('admin.pengaduan.destroy',$pengaduan) }}"
 method="POST"
 class="inline mb-0"
 onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">

 @csrf
 @method('DELETE')

 <button
 type="submit"
 class="inline-flex items-center justify-center gap-2 px-3 py-1.5 text-xs font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm active:scale-95"
 title="Hapus">

 <i class="fa-solid fa-trash"></i>

 </button>

 </form>

 </div>"""

new_actions = """ <div class="flex items-center justify-center gap-2">
 <a href="{{ route('admin.pengaduan.show',$pengaduan) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 transition-colors focus:outline-none" title="Detail">
 <i class="fa-solid fa-eye"></i>
 </a>
 <form action="{{ route('admin.pengaduan.destroy',$pengaduan) }}" method="POST" class="inline mb-0" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
 @csrf
 @method('DELETE')
 <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 transition-colors focus:outline-none" title="Hapus">
 <i class="fa-solid fa-trash"></i>
 </button>
 </form>
 </div>"""

content = content.replace(old_actions, new_actions)

# Fix empty state
old_empty = """ <td colspan="9" class="text-center py-8 px-4 border-b border-slate-100">

 <i class="fa-solid fa-inbox text-5xl text-slate-300 mb-4 block"></i>

 <h5 class="text-lg font-bold text-slate-700 mb-2">
 Belum Ada Pengaduan
 </h5>

 <p class="text-slate-500 mb-0">
 Pengaduan dari masyarakat akan tampil di sini.
 </p>

 </td>"""

new_empty = """ <td colspan="9" class="px-6 py-12 text-center">
 <div class="flex flex-col items-center justify-center text-slate-400">
 <i class="fa-solid fa-inbox text-4xl mb-4 text-slate-300"></i>
 <p class="text-sm">Belum ada data pengaduan yang masuk.</p>
 </div>
 </td>"""
content = content.replace(old_empty, new_empty)

# Fix pagination wrapper
old_paginator = """  @if($pengaduans->hasPages())

 <div class="px-6 py-4 border-t border-slate-200 bg-white">

 {{ $pengaduans->links('pagination::tailwind') }}

 </div>

 @endif

 </div>"""
new_paginator = """  @if($pengaduans->hasPages())
 <div class="px-6 py-4 border-t border-slate-100 bg-white">
 {{ $pengaduans->links() }}
 </div>
 @endif
"""
content = content.replace(old_paginator, new_paginator)
content = content.replace(' </div>\n\n @if($pengaduans->hasPages())', ' @if($pengaduans->hasPages())') # remove the extra div from p-0

with open(filepath, 'w') as f:
    f.write(content)

print("Fixed pengaduan index!")
