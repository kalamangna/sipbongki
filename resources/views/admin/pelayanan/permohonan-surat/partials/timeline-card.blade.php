<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white d-flex align-items-center">

        <i class="fa-solid fa-clock-rotate-left text-primary fs-4 me-2"></i>

        <div>

            <h5 class="mb-0 fw-semibold">
                Riwayat Pelayanan
            </h5>

            <small class="text-muted">
                Riwayat proses permohonan surat
            </small>

        </div>

    </div>

    <div class="card-body">

        <div class="timeline">

            {{-- Permohonan Dibuat --}}
            <div class="d-flex mb-4">

                <div class="me-3">

                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                        style="width:42px;height:42px;">

                        <i class="fa-solid fa-file-circle-plus"></i>

                    </div>

                </div>

                <div class="flex-grow-1">

                    <div class="fw-semibold">
                        Permohonan Dibuat
                    </div>

                    <small class="text-muted d-block">

                        {{ $permohonanSurat->created_at->translatedFormat('d F Y H:i') }}

                    </small>

                    <small class="text-secondary">

                        Data permohonan berhasil dibuat oleh operator.

                    </small>

                </div>

            </div>


            {{-- Diproses --}}
            @if(
                in_array($permohonanSurat->status,['Diproses','Selesai'])
            )

            <div class="d-flex mb-4">

                <div class="me-3">

                    <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center"
                        style="width:42px;height:42px;">

                        <i class="fa-solid fa-rotate"></i>

                    </div>

                </div>

                <div class="flex-grow-1">

                    <div class="fw-semibold">
                        Permohonan Diproses
                    </div>

                    <small class="text-info">

                        Sedang diproses oleh petugas pelayanan.

                    </small>

                </div>

            </div>

            @endif


            {{-- Ditolak --}}
            @if($permohonanSurat->status=='Ditolak')

            <div class="d-flex">

                <div class="me-3">

                    <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
                        style="width:42px;height:42px;">

                        <i class="fa-solid fa-circle-xmark"></i>

                    </div>

                </div>

                <div class="flex-grow-1">

                    <div class="fw-semibold text-danger">
                        Permohonan Ditolak
                    </div>

                    <small class="text-muted">

                        Permohonan tidak dapat diproses.

                    </small>

                </div>

            </div>

            @endif


            {{-- Selesai --}}
            @if($permohonanSurat->status=='Selesai')

            <div class="d-flex">

                <div class="me-3">

                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
                        style="width:42px;height:42px;">

                        <i class="fa-solid fa-circle-check"></i>

                    </div>

                </div>

                <div class="flex-grow-1">

                    <div class="fw-semibold text-success">
                        Surat Selesai
                    </div>

                    <small class="text-muted">

                        Surat telah selesai diproses dan siap dicetak.

                    </small>

                </div>

            </div>

            @endif

        </div>

    </div>

</div>