<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <h3 class="fw-bold mb-2">

                    Detail Permohonan Surat

                </h3>

                <small class="text-muted">

                    Nomor Permohonan

                </small>

                <h5 class="fw-semibold text-primary mt-2">

                    {{ $permohonanSurat->nomor_permohonan }}

                </h5>

            </div>

            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">

                <span class="badge bg-{{ $permohonanSurat->status_badge_class }} fs-6 px-4 py-3 rounded-pill">

                    {{ strtoupper($permohonanSurat->status) }}

                </span>

            </div>

        </div>

    </div>

</div>