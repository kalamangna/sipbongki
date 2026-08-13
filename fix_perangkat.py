import os

def fix_create_edit(filepath):
    with open(filepath, 'r') as f:
        content = f.read()

    # Wrap the form contents in the standard single card
    if '<form' in content and 'bg-white rounded-2xl border border-slate-200' not in content[content.find('<form'):]:
        # Replace form class="space-y-6" with normal form
        content = content.replace('class="space-y-6"', 'id="formPerangkat"')
        
        # Add the master card wrapper after @csrf
        if '@method("PUT")' in content:
            content = content.replace('@method("PUT")', '@method("PUT")\n\n        {{-- Main Form Card --}}\n        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">\n            <div class="p-6 md:p-8 space-y-8">')
        else:
            content = content.replace('@csrf', '@csrf\n\n        {{-- Main Form Card --}}\n        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">\n            <div class="p-6 md:p-8 space-y-8">')
        
        # Update error block to match penduduk
        old_error = """        @if ($errors->any())
            <div class="p-4 rounded-xl bg-red-50 border border-red-100 flex gap-3 items-start shadow-sm">
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
        
        new_error = """                @if ($errors->any())
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
        
        # Replace the detached footer with the attached footer
        old_footer = """        <div class="bg-slate-50/50 px-6 py-4 rounded-2xl border border-slate-200 shadow-sm flex justify-end gap-3 items-center">
            <a href="{{ route('admin.perangkat.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 active:scale-95 cursor-pointer">
                <i class="fa-solid fa-save"></i> Simpan Data
            </button>
        </div>"""
        
        old_footer_edit = old_footer.replace("Simpan Data", "Perbarui Data")
        
        new_footer = """            </div>
            
            <div class="bg-slate-50/50 border-t border-slate-200 px-6 md:px-8 py-4 flex items-center justify-end gap-3">
                <a href="{{ route('admin.perangkat.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer">
                    <i class="fa-solid fa-save"></i> {button_text}
                </button>
            </div>
        </div>"""
        
        if "Simpan Data" in content:
             content = content.replace(old_footer, new_footer.replace('{button_text}', 'Simpan Data'))
        else:
             content = content.replace(old_footer_edit, new_footer.replace('{button_text}', 'Perbarui Data'))
        
        with open(filepath, 'w') as f:
            f.write(content)

def fix_form(filepath):
    with open(filepath, 'r') as f:
        content = f.read()

    # Remove outer cards in form.blade.php
    content = content.replace('<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-full">', '<div class="h-full">')
    content = content.replace('<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">', '<div>')
    
    # Change card headers to simple headers with underline
    content = content.replace('<div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">', '<div class="pb-3 border-b border-slate-100 flex items-center gap-2 mb-6">')
    
    # Remove padding from inner wrappers
    content = content.replace('<div class="p-6 md:p-8 space-y-6">', '<div class="space-y-6">')
    content = content.replace('<div class="p-6 space-y-6">', '<div class="space-y-6">')
    
    with open(filepath, 'w') as f:
        f.write(content)

base = "/Users/abedzul/Desktop/htdocs/sipbongki/resources/views/admin/kependudukan/perangkat/"
fix_create_edit(base + "create.blade.php")
fix_create_edit(base + "edit.blade.php")
fix_form(base + "form.blade.php")

print("Fixed Perangkat!")
