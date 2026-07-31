<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white d-flex align-items-center">

        <i class="bi bi-chat-square-text text-primary fs-4 me-2"></i>

        <div>

            <h5 class="mb-0 fw-semibold">
                Catatan Petugas
            </h5>

            <small class="text-muted">
                Informasi tambahan dari operator pelayanan
            </small>

        </div>

    </div>

    <div class="card-body">

        @if(!empty($permohonanSurat->catatan))

            <div class="alert alert-warning border-0 mb-0 rounded-3">

                <div class="d-flex align-items-start">

                    <i class="bi bi-pencil-square fs-4 me-3"></i>

                    <div>

                        <div class="fw-semibold mb-2">
                            Catatan Operator
                        </div>

                        <div class="lh-lg">

                            {!! nl2br(e($permohonanSurat->catatan)) !!}

                        </div>

                    </div>

                </div>

            </div>

        @else

            <div class="text-center py-5">

                <i class="bi bi-chat-left-dots text-secondary"
                   style="font-size:48px;"></i>

                <h6 class="mt-3">
                    Belum Ada Catatan
                </h6>

                <p class="text-muted mb-0">

                    Operator belum memberikan catatan tambahan
                    untuk permohonan ini.

                </p>

            </div>

        @endif

    </div>

</div>