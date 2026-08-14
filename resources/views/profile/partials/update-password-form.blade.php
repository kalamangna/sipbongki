<form method="post" action="{{ route('password.update') }}" class="space-y-5">
    @csrf
    @method('put')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="md:col-span-2">
            <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password Saat Ini <span class="text-rose-500">*</span></label>
            <input id="update_password_current_password" name="current_password" type="password"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-500/20 outline-none transition-colors @error('current_password', 'updatePassword') border-rose-300 focus:border-rose-500 focus:ring-rose-500/20 @enderror"
                   autocomplete="current-password" placeholder="Masukkan password saat ini">
            @error('current_password', 'updatePassword')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password Baru <span class="text-rose-500">*</span></label>
            <input id="update_password_password" name="password" type="password"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-500/20 outline-none transition-colors @error('password', 'updatePassword') border-rose-300 focus:border-rose-500 focus:ring-rose-500/20 @enderror"
                   autocomplete="new-password" placeholder="Minimal 8 karakter">
            @error('password', 'updatePassword')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password Baru <span class="text-rose-500">*</span></label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-500/20 outline-none transition-colors @error('password_confirmation', 'updatePassword') border-rose-300 focus:border-rose-500 focus:ring-rose-500/20 @enderror"
                   autocomplete="new-password" placeholder="Ulangi password baru">
            @error('password_confirmation', 'updatePassword')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-center gap-3 pt-3 border-t border-slate-100">
        <button type="submit"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5 active:scale-95 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary-500">
            <i class="fa-solid fa-key text-xs"></i>
            Perbarui Password
        </button>

        @if (session('status') === 'password-updated')
            <span class="inline-flex items-center gap-1.5 text-xs text-emerald-600 font-semibold bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200">
                <i class="fa-solid fa-circle-check"></i>
                Password berhasil diubah
            </span>
        @endif
    </div>
</form>
