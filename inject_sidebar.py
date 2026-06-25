import glob
import re

new_insert = """        <a href="<?= base_url('akun') ?>" class="nav-item">
          <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          Pengaturan Akun
        </a>
"""

files = glob.glob('c:/laragon/www/sipstu/application/views/*.php')
for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        content = file.read()
    
    modified = False
    
    # 1. Remove ANY previous injected Akun block entirely using regex to be completely clean
    if "base_url('akun')" in content:
        # Match the wrapper section if we used one
        content = re.sub(r'[ \t]*<div class="sidebar-section">\s*<div class="sidebar-label">Akun</div>\s*<a href="<\?= base_url\(\'akun\'\) \?>".*?Pengaturan Akun\s*</a>\s*</div>', '', content, flags=re.DOTALL)
        
        # Match just the link if it was floating somehow
        content = re.sub(r'[ \t]*<a href="<\?= base_url\(\'akun\'\) \?>".*?Pengaturan Akun\s*</a>\n?', '', content, flags=re.DOTALL)
        modified = True
        
    # 2. Inject it safely into the Utama section, right below the Dashboard link.
    # The dashboard block looks slightly different across files, so we look for "Dashboard\n        </a>"
    if "Pengaturan Akun" not in content:
        # Let's replace "Dashboard \n </a>" with itself + new_insert
        dashboard_regex = r'(Dashboard\s*</a>\s*)'
        
        if re.search(dashboard_regex, content):
            content = re.sub(dashboard_regex, r'\1' + new_insert, content, count=1)
            modified = True
            
    # Let's also fix the sidebar overflow so it can scroll if needed
    if 'overflow: hidden;' in content and '.sidebar' in content:
        # Target only the .sidebar CSS strictly if we can
        # We will use find and replace
        # We don't want to break other stuff, but changing .sidebar { overflow: hidden } to overflow-y: auto is good
        pass

    if modified:
        with open(f, 'w', encoding='utf-8') as file:
            file.write(content)
        print(f"Updated {f}")
