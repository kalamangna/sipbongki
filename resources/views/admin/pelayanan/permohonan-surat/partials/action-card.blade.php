<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white d-flex align-items-center">

        <i class="fa-solid fa-bolt text-primary fs-4 me-2"></i>

        <div>

            <h5 class="mb-0 fw-semibold">
                Aksi Pelayanan
            </h5>

            <small class="text-muted">
                Kelola proses permohonan surat
            </small>

        </div>

    </div>

    <div class="card-body">

        {{-- =========================
             STATUS MENUNGGU
        ========================== --}}
        @if($permohonanSurat->status=='Menunggu')

            <div class="d-grid gap-3">

                <form
                    action="{{ route('admin.permohonan-surat.update-status',$permohonanSurat) }}"
                    method="POST">

                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="Diproses">

                    <button
                        class="btn btn-primary btn-lg w-100"
                        onclick="return confirm('Proses permohonan ini?')">

                        <i class="fa-solid fa-circle-play me-2"></i>

                        Proses Permohonan

                    </button>

                </form>

                <form
                    action="{{ route('admin.permohonan-surat.update-status',$permohonanSurat) }}"
                    method="POST">

                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="Ditolak">

                    <button
                        class="btn btn-outline-danger btn-lg w-100"
                        onclick="return confirm('Tolak permohonan ini?')">

                        <i class="fa-solid fa-circle-xmark me-2"></i>

                        Tolak Permohonan

                    </button>

                </form>

            </div>

        @endif


        {{-- =========================
             STATUS DIPROSES
        ========================== --}}
        @if($permohonanSurat->status=='Diproses')

            <div class="d-grid gap-3">

                <a
                    href="{{ route('admin.permohonan-surat.preview',$permohonanSurat) }}"
                    class="btn btn-info btn-lg">

                    <i class="fa-solid fa-eye me-2"></i>

                    Preview Surat

                </a>

                <a
                    href="{{ route('admin.permohonan-surat.print',$permohonanSurat) }}"
                    target="_blank"
                    class="btn btn-secondary btn-lg">

                    <i class="fa-solid fa-print me-2"></i>

                    Cetak Surat

                </a>

                <form
                    action="{{ route('admin.permohonan-surat.update-status',$permohonanSurat) }}"
                    method="POST">

                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="status"
                        value="Selesai">

                    <button
                        class="btn btn-success btn-lg w-100"
                        onclick="return confirm('Selesaikan permohonan ini?')">

                        <i class="fa-solid fa-circle-check me-2"></i>

                        Selesaikan Permohonan

                    </button>

                </form>

            </div>

        @endif


        {{-- =========================
             STATUS SELESAI
        ========================== --}}
        @if($permohonanSurat->status=='Selesai')

            <div class="d-grid gap-3">

                <a
                    href="{{ route('admin.permohonan-surat.preview',$permohonanSurat) }}"
                    class="btn btn-info btn-lg">

                    <i class="fa-solid fa-eye me-2"></i>

                    Preview Surat

                </a>

                <a
                    href="{{ route('admin.permohonan-surat.print',$permohonanSurat) }}"
                    target="_blank"
                    class="btn btn-success btn-lg">

                    <i class="fa-solid fa-print me-2"></i>

                    Cetak Surat

                </a>

            </div>

        @endif


        {{-- =========================
             EDIT
        ========================== --}}

        <hr>

        <a
            href="{{ route('admin.permohonan-surat.edit',$permohonanSurat) }}"
            class="btn btn-warning w-100">

            <i class="fa-solid fa-pen-square me-2"></i>

            Edit Permohonan

        </a>

    </div>

</div>