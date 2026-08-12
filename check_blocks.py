import re

with open('resources/views/admin/pelayanan/permohonan-surat/form.blade.php', 'r') as f:
    lines = f.readlines()

stack = []
for i, line in enumerate(lines):
    # Process opening divs
    for match in re.finditer(r'<div\b[^>]*>', line):
        tag = match.group(0)
        id_match = re.search(r'id="([^"]+)"', tag)
        div_id = id_match.group(1) if id_match else None
        stack.append({'line': i+1, 'id': div_id})
        if div_id in ['usaha-fields', 'kematian-fields', 'orang-sama-fields', 'domisili-fields', 'pemohon-field']:
            print(f"Opened {div_id} at line {i+1}, depth {len(stack)}")
            
    # Process closing divs
    for _ in re.findall(r'</div\b', line):
        if stack:
            popped = stack.pop()
            if popped['id'] in ['usaha-fields', 'kematian-fields', 'orang-sama-fields', 'domisili-fields', 'pemohon-field']:
                print(f"Closed {popped['id']} (opened at {popped['line']}) at line {i+1}, depth {len(stack)}")
