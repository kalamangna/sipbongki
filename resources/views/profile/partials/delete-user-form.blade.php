<div class="space-y-4">
    <div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-sm">
        <p class="font-semibold mb-1"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Perhatian Penting</p>
        <p class="text-xs text-rose-700 leading-relaxed">Setelah akun dihapus, semua data dan hak akses Anda akan hilang secara permanen dari sistem.</p>
    </div>

    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
        @csrf
        @method('delete')

        <div>
            <label for="delete_account_password" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password</label>
            <input id="delete_account_password" name="password" type="password"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:border-rose-600 focus:ring-2 focus:ring-rose-500/20 outline-none transition-colors @error('password', 'userDeletion') border-rose-300 focus:border-rose-500 focus:ring-rose-500/20 @enderror"
                   placeholder="Masukkan password untuk konfirmasi">
            @error('password', 'userDeletion')
                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen?');"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5 active:scale-95 cursor-pointer focus:outline-none focus:ring-2 focus:ring-rose-500">
            <i class="fa-solid fa-trash text-xs"></i>
            Hapus Akun
        </button>
    </form>
</div>
