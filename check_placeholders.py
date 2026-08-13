import os
import re

directory = 'resources/views/admin'

# Regex to match input and textarea tags
input_pattern = re.compile(r'<input\s+([^>]*?)>', re.IGNORECASE)
textarea_pattern = re.compile(r'<textarea\s+([^>]*?)>', re.IGNORECASE)

# Types of inputs that usually need placeholders
text_input_types = ['text', 'email', 'password', 'number', 'tel', 'url', 'search']

def get_attributes(tag_content):
    attrs = {}
    # Simple regex to get attributes, handles single and double quotes
    attr_matches = re.finditer(r'([a-zA-Z0-9_\-]+)(?:=(?:"([^"]*)"|\'([^\']*)\'|([^ >]+)))?', tag_content)
    for match in attr_matches:
        name = match.group(1).lower()
        val = match.group(2) or match.group(3) or match.group(4) or ''
        attrs[name] = val
    return attrs

for root, _, files in os.walk(directory):
    for file in files:
        if file.endswith('.blade.php'):
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
                
            lines = content.split('\n')
            
            # We'll just read line by line to get line numbers easily
            # However, tags can span multiple lines. For simplicity, we search the whole text
            # and count newlines to get line number.
            
            for match in input_pattern.finditer(content):
                tag_content = match.group(1)
                attrs = get_attributes(tag_content)
                
                type_val = attrs.get('type', 'text').lower()
                if type_val in text_input_types and 'placeholder' not in attrs:
                    # Exclude inputs that are readonly or disabled?
                    # Let's just list them.
                    line_no = content[:match.start()].count('\n') + 1
                    print(f"{filepath}:{line_no}: <input type='{type_val}'> is missing placeholder")
                    
            for match in textarea_pattern.finditer(content):
                tag_content = match.group(1)
                attrs = get_attributes(tag_content)
                
                if 'placeholder' not in attrs:
                    line_no = content[:match.start()].count('\n') + 1
                    print(f"{filepath}:{line_no}: <textarea> is missing placeholder")

