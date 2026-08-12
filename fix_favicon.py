import os
import re

directories = ['resources/views/layouts', 'resources/views/surat/layouts', 'resources/views']
favicon_tag = "\n    <link rel=\"icon\" type=\"image/png\" href=\"{{ asset('images/logo.png') }}\">"

for d in directories:
    if os.path.exists(d):
        for root, dirs, files in os.walk(d):
            # Only process top level of resources/views to not break components
            if d == 'resources/views' and root != d:
                continue
                
            for file in files:
                if file.endswith('.blade.php'):
                    filepath = os.path.join(root, file)
                    with open(filepath, 'r') as f:
                        content = f.read()

                    if '<head>' in content or '</head>' in content:
                        # Remove existing favicon links
                        content = re.sub(r'<link[^>]+rel=[\'"]?(?:shortcut )?icon[\'"]?[^>]*>', '', content, flags=re.IGNORECASE)
                        
                        # Remove the dynamic favicon block if it exists
                        content = re.sub(r'\{\{-- FAVICON --\}\}.*?@endif', '', content, flags=re.IGNORECASE|re.DOTALL)
                        
                        # Insert new favicon tag after <title> or before </head>
                        if '</title>' in content:
                            content = re.sub(r'(</title>)', r'\1' + favicon_tag, content, count=1, flags=re.IGNORECASE)
                        else:
                            content = re.sub(r'(</head>)', favicon_tag + r'\n\1', content, count=1, flags=re.IGNORECASE)
                        
                        with open(filepath, 'w') as f:
                            f.write(content)
                        print(f"Added favicon to {filepath}")

