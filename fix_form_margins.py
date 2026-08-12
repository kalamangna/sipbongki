import re

file_path = 'resources/views/admin/pelayanan/permohonan-surat/form.blade.php'
with open(file_path, 'r') as f:
    content = f.read()

# Remove all margin bottoms/tops from card wrappers because parent <form> has space-y-6
content = re.sub(r'overflow-hidden mb-6 mt-6 mb-4', 'overflow-hidden', content)
content = re.sub(r'overflow-hidden mb-6 mt-6', 'overflow-hidden', content)
content = re.sub(r'overflow-hidden mb-6', 'overflow-hidden', content)
content = re.sub(r'overflow-hidden mb-4', 'overflow-hidden', content)
content = re.sub(r'overflow-hidden mt-6', 'overflow-hidden', content)

with open(file_path, 'w') as f:
    f.write(content)
