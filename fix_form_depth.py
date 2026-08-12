import re

file_path = 'resources/views/admin/pelayanan/permohonan-surat/form.blade.php'
with open(file_path, 'r') as f:
    content = f.read()

# Fix the depth issue by removing exactly 3 `</div>` before the script tag.
# We had 3 extra closing tags due to my sed command breaking things.
marker = "</div>\n</div>\n</div>\n\n<script>"
fixed_marker = "\n<script>"

if marker in content:
    content = content.replace(marker, fixed_marker)
else:
    # Just aggressively strip extra closing divs before script
    content = re.sub(r'(</div>\s*){3}<script>', '<script>', content)

# Since we removed mb-6 mt-6 from cards earlier, now they are just stacked together without margins
# because we removed the `space-y-6` wrappers! We need to add back `space-y-6` to the main container,
# or add `mb-6` to each card.
# Actually, the parent <form> in create.blade.php and edit.blade.php ALREADY has `space-y-6`.
# So we don't need `mb-6` on the cards! They will space out automatically!

# But wait, what if the user meant "form tidak full width" because the `max-w` was constrained?
# In create.blade.php, we have `<div class="w-full">`, so there's no max width.
# If they are complaining about not full width, it's 100% because the 2-column KIRI/KANAN layout
# squished the cards into 50% width on large screens!
# By removing `grid-cols-1 lg:grid-cols-2`, each card now naturally takes 100% width.

with open(file_path, 'w') as f:
    f.write(content)
