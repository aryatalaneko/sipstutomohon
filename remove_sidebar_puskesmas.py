import glob
import re

files = glob.glob('c:/laragon/www/sipstu/application/views/admin_puskesmas_*.php')
files.extend(glob.glob('c:/laragon/www/sipstu/application/views/puskesmas_*.php')) # just in case

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        content = file.read()
    
    modified = False
    
    if "base_url('akun')" in content:
        # Match just the link that we inserted over under Dashboard
        content = re.sub(r'[ \t]*<a href="<\?= base_url\(\'akun\'\) \?>".*?Pengaturan Akun\s*</a>\n?', '', content, flags=re.DOTALL)
        modified = True
        
    if modified:
        with open(f, 'w', encoding='utf-8') as file:
            file.write(content)
        print(f"Updated {f}")
