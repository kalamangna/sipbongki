import os

filepath = "/Users/abedzul/Desktop/htdocs/sipbongki/resources/views/admin/pengaduan/edit.blade.php"
with open(filepath, 'r') as f:
    content = f.read()

# Replace error block
old_error = """ @if ($errors->any())
 <div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200">
 <strong>Error Validasi</strong>
 <ul class="mb-0 mt-2">
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 @endif"""

new_error = """ @if ($errors->any())
 <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 flex gap-3 items-start">
 <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5"></i>
 <div>
 <h4 class="text-sm font-bold text-red-800">Mohon periksa kembali input Anda:</h4>
 <ul class="text-sm text-red-600 mt-1 list-disc list-inside">
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 </div>
 @endif"""

content = content.replace(old_error, new_error)

# Replace the footer block
old_footer = """ <div class="flex justify-end pt-4 border-t border-slate-100 mt-6">
 <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm active:scale-95 cursor-pointer">
 <i class="fa-solid fa-circle-check"></i>
 Simpan Perubahan
 </button>
 </div>

 </form>

 </div>

 </div>"""

new_footer = """ </div>
 
 <div class="bg-slate-50/50 border-t border-slate-200 px-6 py-4 flex items-center justify-end gap-3">
 <a href="{{ route('admin.pengaduan.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none">
 Batal
 </a>
 <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer">
 <i class="fa-solid fa-save"></i> Simpan Perubahan
 </button>
 </div>

 </form>

 </div>"""

content = content.replace(old_footer, new_footer)

with open(filepath, 'w') as f:
    f.write(content)
print("Fixed Pengaduan Edit!")
