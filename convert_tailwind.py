import os
import re

def convert_to_tailwind(content):
    # Common mappings
    mappings = {
        r'\bcard\b': 'bg-white rounded-2xl border border-slate-200/60 shadow-sm',
        r'\bcard-header\b': 'px-6 py-4 border-b border-slate-200',
        r'\bcard-body\b': 'p-6',
        r'\bcard-footer\b': 'px-6 py-4 border-t border-slate-200',
        
        r'\bbtn\b': 'inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all',
        r'\bbtn-primary\b': 'bg-primary-600 text-white hover:bg-primary-700 shadow-sm',
        r'\bbtn-success\b': 'bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm',
        r'\bbtn-warning\b': 'bg-amber-500 text-white hover:bg-amber-600 shadow-sm',
        r'\bbtn-danger\b': 'bg-rose-600 text-white hover:bg-rose-700 shadow-sm',
        r'\bbtn-info\b': 'bg-sky-600 text-white hover:bg-sky-700 shadow-sm',
        r'\bbtn-light\b': 'bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 shadow-sm',
        r'\bbtn-outline-primary\b': 'text-primary-600 border border-primary-600 hover:bg-primary-50',
        r'\bbtn-sm\b': '!px-3 !py-1.5 !text-xs',
        
        r'\bbadge\b': 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold',
        r'\bbg-primary\b': 'bg-primary-100 text-primary-700',
        r'\bbg-success\b': 'bg-emerald-100 text-emerald-700',
        r'\bbg-warning\b': 'bg-amber-100 text-amber-700',
        r'\bbg-danger\b': 'bg-rose-100 text-rose-700',
        r'\bbg-info\b': 'bg-sky-100 text-sky-700',
        r'\bbg-secondary\b': 'bg-slate-100 text-slate-700',
        
        r'\btable\b': 'w-full text-left border-collapse text-sm',
        r'\btable-responsive\b': 'overflow-x-auto w-full',
        
        r'\bd-flex\b': 'flex',
        r'\bjustify-content-between\b': 'justify-between',
        r'\bjustify-content-start\b': 'justify-start',
        r'\bjustify-content-center\b': 'justify-center',
        r'\bjustify-content-end\b': 'justify-end',
        r'\balign-items-center\b': 'items-center',
        r'\bfw-bold\b': 'font-bold',
        r'\btext-muted\b': 'text-slate-500',
        r'\btext-center\b': 'text-center',
        r'\btext-capitalize\b': 'capitalize',
        
        # Grid/Layout replacements are tricky, let's do a basic flex
        r'\brow\b': 'flex flex-wrap -mx-3',
        # col-xl-3 -> w-full xl:w-1/4 px-3
        r'\bcol-xl-3\b': 'w-full xl:w-1/4 px-3',
        r'\bcol-md-6\b': 'w-full md:w-1/2 px-3',
        r'\bcol-12\b': 'w-full px-3',
        r'\bcol-lg-9\b': 'w-full lg:w-3/4 px-3',
        r'\bcol-lg-8\b': 'w-full lg:w-2/3 px-3',
        r'\bcol-lg-4\b': 'w-full lg:w-1/3 px-3',
        r'\bcol-lg-3\b': 'w-full lg:w-1/4 px-3',
        r'\bg-4\b': '', # Handle gap manually if needed
        r'\bmb-0\b': 'mb-0',
        r'\bmb-1\b': 'mb-1',
        r'\bmb-2\b': 'mb-2',
        r'\bmb-3\b': 'mb-4',
        r'\bmb-4\b': 'mb-6',
        r'\bmt-1\b': 'mt-1',
        r'\bmt-2\b': 'mt-2',
        r'\bmt-4\b': 'mt-6',
        r'\bme-1\b': 'mr-1',
        r'\bme-2\b': 'mr-2',
        r'\bms-2\b': 'ml-2',
        r'\bpy-4\b': 'py-4',
        r'\bpy-5\b': 'py-8',
    }

    # Replace classes within class="..." attributes
    def replacer(match):
        classes = match.group(1).split()
        new_classes = []
        for c in classes:
            replaced = False
            for pattern, replacement in mappings.items():
                if re.fullmatch(pattern, c):
                    new_classes.extend(replacement.split())
                    replaced = True
                    break
            if not replaced:
                new_classes.append(c)
        # Deduplicate while preserving order
        seen = set()
        final_classes = [x for x in new_classes if not (x in seen or seen.add(x))]
        return f'class="{" ".join(final_classes)}"'

    content = re.sub(r'class="([^"]*)"', replacer, content)
    return content

for root, _, files in os.walk('resources/views/admin'):
    for file in files:
        if file.endswith('.blade.php'):
            filepath = os.path.join(root, file)
            with open(filepath, 'r') as f:
                original = f.read()
            converted = convert_to_tailwind(original)
            if original != converted:
                with open(filepath, 'w') as f:
                    f.write(converted)
                print(f"Converted {filepath}")

