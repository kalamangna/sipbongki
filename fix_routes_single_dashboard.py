with open('routes/web.php', 'r') as f:
    content = f.read()

# Fix the /dashboard redirect
old_route = """Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'operator') {
        return redirect()->route('operator.dashboard');
    }
    return abort(403, 'Unauthorized action.');
})->middleware(['auth', 'verified'])->name('dashboard');"""

new_route = """Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');"""

content = content.replace(old_route, new_route)

# Now remove the entire Operator group.
import re
# The Operator group starts with Route::prefix('operator')
# and ends with PENUTUP GROUP OPERATOR
pattern = r"/\*\s*\|\-*\s*\|\s*Operator Pelayanan\s*\|\-*\s*\*/\s*Route::prefix\('operator'\).*?// <-- PENUTUP GROUP OPERATOR"
content = re.sub(pattern, "", content, flags=re.DOTALL)

with open('routes/web.php', 'w') as f:
    f.write(content)
