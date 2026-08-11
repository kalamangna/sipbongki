{{-- ═══════════════════════════════════════════════
    SERVICES SECTION — Tailwind CSS
═══════════════════════════════════════════════ --}}
<section id="layanan" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="section-header">
            <span class="section-badge">Pelayanan</span>
            <h2 class="section-title">Layanan Administrasi</h2>
        </div>

        {{-- Cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($jenisSurats ?? [] as $jenisSurat)

                <div class="group flex flex-col bg-white border border-slate-100 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                    <div class="w-14 h-14 rounded-2xl bg-primary-light flex items-center justify-center mb-5 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <i class="{{ $jenisSurat->icon ?? 'fa-solid fa-file-lines' }} text-primary group-hover:text-white transition-colors" style="font-size: 2rem;"></i>
                    </div>

                    <h3 class="text-base font-bold text-slate-800 mb-2">
                        {{ $jenisSurat->nama }}
                    </h3>

                    <p class="text-sm text-slate-500 leading-relaxed flex-1">
                        {{ $jenisSurat->deskripsi ?: 'Pelayanan administrasi Kelurahan Bongki.' }}
                    </p>

                    <div class="flex flex-col gap-2 mt-5 pt-4 border-t border-slate-100">
                        <a href="{{ route('permohonan.create', ['jenis' => $jenisSurat->id]) }}"
                           class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white text-sm font-semibold transition-colors">
                            <i class="fa-solid fa-paper-plane"></i>
                            Ajukan Permohonan
                        </a>
                        <button type="button"
                                onclick="document.getElementById('cekStatusModal').classList.remove('hidden')"
                                class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl border border-primary text-primary hover:bg-primary-light text-sm font-semibold transition-colors">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Cek Status
                        </button>
                    </div>

                </div>

            @empty

                <div class="sm:col-span-2 lg:col-span-3 py-16 text-center text-slate-400">
                    <i class="fa-solid fa-circle-info"></i>
                    <h5 class="text-lg font-semibold text-slate-600 mb-1">Belum Ada Layanan</h5>
                    <p class="text-sm">Jenis pelayanan akan ditampilkan setelah dipublikasikan melalui Dashboard Admin.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>

{{-- Modal: Cek Status Permohonan --}}
<div id="cekStatusModal"
     class="hidden fixed inset-0 z-50 flex items-center justify-center px-4"
     x-data
     @keydown.escape.window="document.getElementById('cekStatusModal').classList.add('hidden')">

    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
         onclick="document.getElementById('cekStatusModal').classList.add('hidden')"></div>

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">

        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-bold text-slate-800">Cek Status Permohonan</h5>
            <button onclick="document.getElementById('cekStatusModal').classList.add('hidden')"
                    class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form method="GET" action="{{ route('permohonan.status.check') }}">
            <p class="text-sm text-slate-500 mb-4">
                Masukkan <strong>Nomor Permohonan</strong> atau <strong>NIK</strong> untuk mengecek status.
                Contoh: <code class="text-xs bg-slate-100 px-1.5 py-0.5 rounded">PMH-20260101010101</code>
            </p>

            <div class="flex flex-col gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nomor Permohonan <span class="text-slate-400">(opsional)</span></label>
                    <input type="text" name="nomor"
                           class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                           placeholder="PMH-...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">NIK <span class="text-slate-400">(opsional)</span></label>
                    <input type="text" name="nik"
                           class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                           placeholder="Contoh: 3276010101010001">
                </div>
                <p class="text-xs text-slate-400">Isi salah satu field di atas. Nomor permohonan diprioritaskan jika keduanya diisi.</p>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="button"
                        onclick="document.getElementById('cekStatusModal').classList.add('hidden')"
                        class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-medium hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white text-sm font-semibold transition-colors">
                    Cek Status
                </button>
            </div>
        </form>

    </div>
</div>