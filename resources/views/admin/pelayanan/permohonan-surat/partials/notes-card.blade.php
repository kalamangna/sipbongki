<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="p-6">

        <form
            action="{{ route('admin.permohonan-surat.update-note', $permohonanSurat) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Catatan Khusus Pelayanan
                </label>

                <textarea
                    name="catatan"
                    rows="5"
                    class="form-control @error('catatan') is-invalid @enderror"
                    placeholder="Tulis catatan khusus untuk warga...">{{ old('catatan', $permohonanSurat->catatan) }}</textarea>

                @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-primary-600 text-white hover:bg-primary-700 shadow-sm">
                    <i class="bi bi-save mr-2"></i>
                    Simpan Catatan
                </button>
            </div>

        </form>

    </div>

</div>