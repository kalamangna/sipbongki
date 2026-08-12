import os
import re

directories = ['resources/views/admin']
reset_button_pattern = re.compile(
    r'<a[^>]*href="\{\{\s*route\(\'([a-zA-Z0-9_.-]+)\'\)\s*\}\}"[^>]*>\s*(?:<i[^>]*></i>\s*)?Reset(?:\s*Filter)?\s*</a>', 
    re.IGNORECASE | re.DOTALL
)

# For cases where href comes after class
reset_button_pattern_2 = re.compile(
    r'<a[^>]*class="[^"]*"[^>]*href="\{\{\s*route\(\'([a-zA-Z0-9_.-]+)\'\)\s*\}\}"[^>]*>\s*(?:<i[^>]*></i>\s*)?Reset(?:\s*Filter)?\s*</a>',
    re.IGNORECASE | re.DOTALL
)

for d in directories:
    for root, dirs, files in os.walk(d):
        for file in files:
            if file.endswith('.blade.php'):
                filepath = os.path.join(root, file)
                with open(filepath, 'r') as f:
                    content = f.read()

                new_content = reset_button_pattern.sub(
                    lambda m: f'<a href="{{{{ route(\'{m.group(1)}\') }}}}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm transition-all focus:outline-none cursor-pointer active:scale-95" title="Reset Filter">\n    <i class="fa-solid fa-rotate-left"></i>\n</a>',
                    content
                )

                if content != new_content:
                    with open(filepath, 'w') as f:
                        f.write(new_content)
                    print(f"Updated reset button in {filepath}")

