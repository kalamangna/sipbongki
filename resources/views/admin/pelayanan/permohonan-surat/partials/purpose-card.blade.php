<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white d-flex align-items-center">

        <i class="fa-solid fa-comment text-primary fs-4 me-2"></i>

        <div>

            <h5 class="mb-0 fw-semibold">
                Keperluan Permohonan
            </h5>

            <small class="text-muted">
                Tujuan dan alasan pengajuan surat
            </small>

        </div>

    </div>

    <div class="card-body">

        @if(!empty($permohonanSurat->keperluan))

            <div class="border rounded-3 bg-light p-4">

                <div class="lh-lg text-dark">

                    {!! nl2br(e($permohonanSurat->keperluan)) !!}

                </div>

            </div>

        @else

            <div class="text-center py-5">

                <i class="fa-solid fa-file-lines fs-1 text-secondary"></i>

                <h6 class="mt-3 mb-2">
                    Belum Ada Keperluan
                </h6>

                <p class="text-muted mb-0">
                    Keperluan permohonan belum diisi oleh operator.
                </p>

            </div>

        @endif

    </div>

</div>