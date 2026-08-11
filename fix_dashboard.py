import os
import re

filepath = 'resources/views/admin/dashboard/dashboard.blade.php'
with open(filepath, 'r') as f:
    content = f.read()

# Replacements
replacements = {
    r'class="shortcut-card"': 'class="bg-white rounded-2xl border border-slate-200/60 p-4 shadow-sm flex items-center gap-4 transition-all hover:-translate-y-1 hover:shadow-md group"',
    r'class="shortcut-icon ([^"]+)"': r'class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0 transition-transform group-hover:scale-110 \1"',
    r'<h5>(.*?)</h5>': r'<h5 class="font-bold text-slate-800 text-sm mb-0.5">\1</h5>',
    r'<p>Data(.*?)</p>': r'<p class="text-xs text-slate-500">Data\1</p>',
    r'<p>Kelola(.*?)</p>': r'<p class="text-xs text-slate-500">Kelola\1</p>',
    r'<p>Pelayanan(.*?)</p>': r'<p class="text-xs text-slate-500">Pelayanan\1</p>',
    
    # Dashboard Card
    r'class="card dashboard-card h-100"': 'class="bg-white rounded-2xl border border-slate-200/60 shadow-sm h-full flex flex-col overflow-hidden"',
    r'class="card dashboard-card h-100 dashboard-wide-card"': 'class="bg-white rounded-2xl border border-slate-200/60 shadow-sm h-full flex flex-col overflow-hidden"',
    
    # Activity Item
    r'class="activity-item"': 'class="flex gap-4 p-4 border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors"',
    r'class="activity-icon success"': 'class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0"',
    r'class="activity-icon primary"': 'class="w-10 h-10 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center shrink-0"',
    r'class="activity-icon warning"': 'class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0"',
    r'class="activity-icon danger"': 'class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0"',
    r'class="activity-icon ([^"]+)"': r'class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 \1"',
    
    # Stat Details
    r'class="stat-detail-block([^"]*)"': r'class="bg-slate-50 rounded-xl p-4\1"',
    r'class="stat-row-item([^"]*)"': r'class="mb-3 last:mb-0\1"',
    r'<h6>(.*?)</h6>': r'<h6 class="font-bold text-slate-700 text-sm mb-3">\1</h6>',
    r'class="progress mt-1"': 'class="w-full bg-slate-200 rounded-full h-1.5 mt-2 overflow-hidden"',
    r'class="progress-bar ([^"]+)"': r'class="h-1.5 rounded-full \1"',
    r'class="progress"': 'class="w-full bg-slate-200 rounded-full h-1.5 overflow-hidden"',
    
    # Text adjustments
    r'<strong>(.*?)</strong>': r'<strong class="font-bold text-slate-800">\1</strong>',
}

for pattern, repl in replacements.items():
    content = re.sub(pattern, repl, content)

with open(filepath, 'w') as f:
    f.write(content)

