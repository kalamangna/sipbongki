import os
import re

replacements = {
    "'Dashboard Utama'": "'Dashboard'",
    "'Manajemen User'": "'User'",
    "'Manajemen Halaman Website'": "'Halaman'",
    "'Manajemen Berita'": "'Berita'",
    "'Manajemen Pengumuman'": "'Pengumuman'",
    "'Manajemen Agenda'": "'Agenda'",
    "'Manajemen Galeri'": "'Galeri'",
    "'Data Permohonan Surat'": "'Permohonan Surat'",
    "'Data Pengaduan'": "'Pengaduan'",
    "'Data Jabatan'": "'Jabatan'",
    "'Data Lingkungan'": "'Lingkungan'",
    "'Data Perangkat Kelurahan'": "'Perangkat Kelurahan'",
    "'Data Kartu Keluarga'": "'Kartu Keluarga'",
    "'Data Penduduk'": "'Penduduk'",
    "'Dashboard Laporan'": "'Laporan'"
}

def replace_titles(directory):
    for root, dirs, files in os.walk(directory):
        for file in files:
            if file.endswith('.blade.php'):
                filepath = os.path.join(root, file)
                with open(filepath, 'r') as f:
                    content = f.read()
                
                original_content = content
                for old, new in replacements.items():
                    # Using regex to ensure exact match of the title parameter
                    pattern = r"@section\('title',\s*" + old + r"\)"
                    replacement = f"@section('title', {new})"
                    content = re.sub(pattern, replacement, content)
                
                if content != original_content:
                    with open(filepath, 'w') as f:
                        f.write(content)
                    print(f"Updated titles in {filepath}")

replace_titles('resources/views')
