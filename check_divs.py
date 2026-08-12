import re
with open('resources/views/admin/pelayanan/permohonan-surat/form.blade.php', 'r') as f:
    text = f.read()

lines = text.split('\n')
stack = []
for i, line in enumerate(lines):
    opens = len(re.findall(r'<div\b', line))
    closes = len(re.findall(r'</div\b', line))
    for _ in range(opens):
        stack.append(i + 1)
    for _ in range(closes):
        if stack:
            stack.pop()
        else:
            print(f"Extra closing div at line {i + 1}")

if stack:
    print(f"Unclosed divs opened at lines: {stack}")
else:
    print("Divs are perfectly balanced!")
