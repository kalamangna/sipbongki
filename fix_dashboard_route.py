with open('routes/web.php', 'r') as f:
    content = f.read()

old_route = """Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');"""

new_route = """Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'operator') {
        return redirect()->route('operator.dashboard');
    }
    return abort(403, 'Unauthorized action.');
})->middleware(['auth', 'verified'])->name('dashboard');"""

content = content.replace(old_route, new_route)

with open('routes/web.php', 'w') as f:
    f.write(content)
