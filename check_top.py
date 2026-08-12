import re

with open('resources/views/admin/pelayanan/permohonan-surat/form.blade.php', 'r') as f:
    lines = f.readlines()

stack = []
for i, line in enumerate(lines[:90]):
    for match in re.finditer(r'<div\b[^>]*>', line):
        stack.append(i+1)
    for _ in re.findall(r'</div\b', line):
        if stack:
            stack.pop()

print("Open divs at line 90:")
for s in stack:
    print(f"Line {s}")
