import os
import re

def process_file(filepath):
    with open(filepath, 'r') as f:
        content = f.read()

    # Convert modal triggers
    content = re.sub(r'data-bs-toggle="modal"', '', content)
    content = re.sub(r'data-bs-target="#([^"]+)"', r'data-modal-target="\1" data-modal-toggle="\1"', content)

    # Convert modal dismiss buttons
    content = re.sub(r'data-bs-dismiss="modal"', r'data-modal-hide="modal"', content)
    # We will need to fix data-modal-hide to target the specific ID later, or rely on Flowbite's generic behavior.
    # Actually, flowbite supports `data-modal-hide` with the target ID.
    # To do it properly:
    def replace_modal(match):
        modal_id = match.group(1)
        inner_content = match.group(2)
        
        # Replace data-bs-dismiss="modal" inside this modal with data-modal-hide="modal_id"
        inner_content = re.sub(r'data-modal-hide="modal"|data-bs-dismiss="modal"', f'data-modal-hide="{modal_id}"', inner_content)
        
        # Build Flowbite modal
        new_modal = f"""<div id="{modal_id}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-2xl shadow-sm border border-slate-200">
{inner_content}
        </div>
    </div>
</div>"""
        
        # Fix header
        new_modal = re.sub(r'<div class="modal-header[^>]*>[\s\S]*?<h5 class="modal-title[^>]*>([\s\S]*?)<\/h5>[\s\S]*?<button[^>]*>[\s\S]*?<\/button>[\s\S]*?<\/div>',
                           rf'''<div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50 text-slate-800 rounded-t-2xl">
                <h5 class="font-bold text-lg mb-0">\1</h5>
                <button type="button" class="text-slate-400 hover:text-slate-600 transition-colors" data-modal-hide="{modal_id}">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>''', new_modal)
            
        # Fix body
        new_modal = re.sub(r'<div class="modal-body">', r'<div class="p-6">', new_modal)
        
        # Fix footer
        new_modal = re.sub(r'<div class="modal-footer">', r'<div class="px-6 py-4 border-t border-slate-100 flex justify-end gap-3 bg-slate-50 rounded-b-2xl">', new_modal)
        
        return new_modal

    # Match the entire modal structure. This regex assumes no nested modals.
    modal_regex = re.compile(r'<div\s+class="modal\s+fade"\s+id="([^"]+)"\s+tabindex="-1"[^>]*>\s*<div\s+class="modal-dialog[^>]*>\s*<div\s+class="modal-content[^>]*>([\s\S]*?)\s*<\/div>\s*<\/div>\s*<\/div>')
    
    content = modal_regex.sub(replace_modal, content)

    # Standardize buttons
    content = re.sub(r'active:scale-95\s+', '', content)
    content = re.sub(r'(class="[^"]*?(?:btn|hover:bg|transition|shadow)[^"]*?")', r'\1', content) 
    
    with open(filepath, 'w') as f:
        f.write(content)

for root, dirs, files in os.walk('resources/views/admin'):
    for file in files:
        if file.endswith('.blade.php'):
            process_file(os.path.join(root, file))
print("Done processing files.")
