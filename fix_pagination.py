import os
import re

def process_file(filepath):
    with open(filepath, 'r') as f:
        content = f.read()

    # Find the pagination variable
    match = re.search(r'\{\{\s*\$([a-zA-Z0-9_]+)->(?:withQueryString\(\)->)?links\([^\)]*\)\s*\}\}', content)
    if not match:
        return
    
    var_name = match.group(1)

    # Check if it already has hasPages()
    if f"${var_name}->hasPages()" in content:
        # It has it, but let's check if there is an empty div wrapper issue
        pass
    else:
        # Wrap it!
        # First, find the container div if it exists. 
        # Usually it's like <div class="..."> {{ $var->links() }} </div>
        # We can just replace the links call with a wrapped version, but we need to hide the wrapper if it exists.
        # Actually, let's just do a regex replace for the wrapper if we can.
        
        # This is a bit complex for a simple script. 
        pass

for root, dirs, files in os.walk('resources/views/admin'):
    for file in files:
        if file.endswith('.blade.php'):
            process_file(os.path.join(root, file))
