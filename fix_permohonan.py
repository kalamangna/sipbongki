import os

def fix_create_edit(filepath):
    with open(filepath, 'r') as f:
        content = f.read()

    if '<form' in content and 'bg-white rounded-2xl border border-slate-200' not in content[content.find('<form'):]:
        # Wrap the form contents in the standard single card
        content = content.replace('class="space-y-6" id="formPermohonan"', 'id="formPermohonan"')
        
        # Add the master card wrapper
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
        old_footer = """        <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-200 shadow-sm flex justify-end gap-3 items-center">
            <a href="{{ route('admin.permohonan-surat.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none active:scale-95 cursor-pointer">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 active:scale-95 cursor-pointer focus:outline-none active:scale-95 cursor-pointer">
                <i class="fa-solid fa-save"></i> Simpan Permohonan
            </button>
        </div>"""
        
        old_footer_edit = old_footer.replace("Simpan Permohonan", "Perbarui Permohonan")
        
        new_footer = """            </div>
            
            <div class="bg-slate-50/50 border-t border-slate-200 px-6 md:px-8 py-4 flex items-center justify-end gap-3">
                <a href="{{ route('admin.permohonan-surat.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-slate-200 shadow-sm focus:outline-none">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:-translate-y-0.5 shadow-primary-500/20 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer">
                    <i class="fa-solid fa-save"></i> {button_text}
                </button>
            </div>
        </div>"""
        
        if "Simpan Permohonan" in content:
             content = content.replace(old_footer, new_footer.replace('{button_text}', 'Simpan Permohonan'))
        else:
             content = content.replace(old_footer_edit, new_footer.replace('{button_text}', 'Perbarui Permohonan'))
        
        with open(filepath, 'w') as f:
            f.write(content)

def fix_form(filepath):
    with open(filepath, 'r') as f:
        content = f.read()

    # We need to systematically remove the card wrappers but KEEP the IDs because they are toggled by Javascript!
    # e.g., <div id="usaha-fields" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6" style="display:none;">
    # Should become <div id="usaha-fields" style="display:none;">
    
    # Let's replace the outer wrappers. We'll find all class="..." that contain the card styles and just remove them or empty them.
    card_classes_1 = 'class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6"'
    content = content.replace(card_classes_1, 'class="mb-6"')
    
    card_classes_2 = 'class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"'
    content = content.replace(card_classes_2, 'class="mb-6"')
    
    # Inner headers
    # <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">
    # becomes <div class="pb-3 border-b border-slate-100 flex items-center gap-2 mb-6">
    content = content.replace('<div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2 bg-slate-50/50">', '<div class="pb-3 border-b border-slate-100 flex items-center gap-2 mb-6">')
    
    # Remove padding from content blocks
    # <div class="p-6"> -> <div>
    content = content.replace('<div class="p-6">', '<div>')
    
    with open(filepath, 'w') as f:
        f.write(content)

base = "/Users/abedzul/Desktop/htdocs/sipbongki/resources/views/admin/pelayanan/permohonan-surat/"
fix_create_edit(base + "create.blade.php")
fix_create_edit(base + "edit.blade.php")
fix_form(base + "form.blade.php")

print("Fixed Permohonan Surat!")
