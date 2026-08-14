<form method="post" action="{{ route('profile.update') }}" class="space-y-5">
    @csrf
    @method('patch')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap <span class="text-rose-500">*</span></label>
            <input id="name" name="name" type="text"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-500/20 outline-none transition-colors @error('name') border-rose-300 focus:border-rose-500 focus:ring-rose-500/20 @enderror"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap">
            @error('name')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="username" class="block text-sm font-semibold text-slate-700 mb-1.5">Username <span class="text-rose-500">*</span></label>
            <input id="username" name="username" type="text"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-500/20 outline-none transition-colors @error('username') border-rose-300 focus:border-rose-500 focus:ring-rose-500/20 @enderror"
                   value="{{ old('username', $user->username) }}" required autocomplete="username" placeholder="Masukkan username">
            @error('username')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Peran / Role</label>
            <input type="text" disabled
                   class="w-full px-4 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-sm text-slate-500 cursor-not-allowed font-medium"
                   value="{{ ucfirst($user->role ?? 'admin') }}">
            <p class="text-[11px] text-slate-400 mt-1">Peran akun dikonfigurasi melalui hak akses sistem.</p>
        </div>

        @if($user->penduduk)
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Terhubung dengan Penduduk</label>
            <div class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 flex items-center justify-between">
                <span class="truncate font-medium">{{ $user->penduduk->nama_lengkap }} ({{ $user->penduduk->nik }})</span>
                <span class="text-xs text-emerald-600 font-semibold shrink-0 ml-2"><i class="fa-solid fa-link"></i> Terkait</span>
            </div>
        </div>
        @endif
    </div>

    <div class="flex items-center gap-3 pt-3 border-t border-slate-100">
        <button type="submit"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5 active:scale-95 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary-500">
            <i class="fa-solid fa-floppy-disk text-xs"></i>
            Simpan Perubahan
        </button>

        @if (session('status') === 'profile-updated')
            <span class="inline-flex items-center gap-1.5 text-xs text-emerald-600 font-semibold bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200">
                <i class="fa-solid fa-circle-check"></i>
                Profil berhasil disimpan
            </span>
        @endif
    </div>
</form>
