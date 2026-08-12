const fs = require('fs');
const path = require('path');

function processDir(dir) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const fullPath = path.join(dir, file);
        if (fs.statSync(fullPath).isDirectory()) {
            processDir(fullPath);
        } else if (fullPath.endsWith('.blade.php')) {
            let content = fs.readFileSync(fullPath, 'utf8');
            
            // Check if file contains bootstrap modal triggers
            if (content.includes('data-bs-toggle="modal"') || content.includes('data-bs-dismiss="modal"')) {
                // Replace triggers
                content = content.replace(/data-bs-toggle="modal"/g, 'data-modal-toggle');
                content = content.replace(/data-bs-target="#([^"]+)"/g, 'data-modal-target="$1"');
                
                // Replace modal wrappers
                const modalRegex = /<div\s+class="modal\s+fade"\s+id="([^"]+)"\s+tabindex="-1"\s+aria-hidden="true">\s*<div\s+class="modal-dialog[^"]*">\s*<div\s+class="modal-content[^"]*">/g;
                content = content.replace(modalRegex, `<div id="$1" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-2xl shadow-sm border border-slate-200">`);
                
                // Replace headers
                const headerRegex = /<div\s+class="modal-header[^"]*">\s*<h5\s+class="modal-title[^"]*">([^<]+)<\/h5>\s*<button[^>]+data-bs-dismiss="modal"[^>]*>[\s\S]*?<\/button>\s*<\/div>/g;
                content = content.replace(headerRegex, `<div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50 rounded-t-2xl">
                <h5 class="font-bold text-lg text-slate-800 mb-0">$1</h5>
                <button type="button" class="text-slate-400 hover:text-slate-600 transition-colors" data-modal-hide="hapusModal{{ $jabatan->id }}">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>`);

                // We'll need a better strategy to handle the dynamic modal IDs like {{ $jabatan->id }} in the dismiss button inside the header loop.
                // Let's do it using a regex function.
            }
        }
    }
}
