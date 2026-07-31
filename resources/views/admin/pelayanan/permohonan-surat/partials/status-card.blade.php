<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white d-flex align-items-center">

        <i class="bi bi-activity text-primary fs-4 me-2"></i>

        <div>

            <h5 class="mb-0 fw-semibold">
                Status Pelayanan
            </h5>

            <small class="text-muted">
                Status proses permohonan saat ini
            </small>

        </div>

    </div>

    <div class="card-body text-center">

        @php

            $icon = match($permohonanSurat->status){

                'Menunggu' => 'bi-hourglass-split',

                'Diproses' => 'bi-arrow-repeat',

                'Selesai' => 'bi-check-circle-fill',

                'Ditolak' => 'bi-x-circle-fill',

                default => 'bi-question-circle',

            };

        @endphp

        <div class="mb-3">

            <i class="bi {{ $icon }} display-4 text-{{ $permohonanSurat->status_badge_class }}"></i>

        </div>

        <span class="badge rounded-pill px-4 py-3 fs-6 bg-{{ $permohonanSurat->status_badge_class }}">

            {{ strtoupper($permohonanSurat->status) }}

        </span>

        <hr class="my-4">

        @switch($permohonanSurat->status)

            @case('Menunggu')

                <div class="text-warning">

                    <h6 class="fw-bold">
                        Menunggu Diproses
                    </h6>

                    <p class="mb-0 text-muted">

                        Permohonan telah diterima dan sedang
                        menunggu verifikasi petugas pelayanan.

                    </p>

                </div>

            @break

            @case('Diproses')

                <div class="text-info">

                    <h6 class="fw-bold">
                        Sedang Diproses
                    </h6>

                    <p class="mb-0 text-muted">

                        Surat sedang diproses dan menunggu
                        penyelesaian administrasi.

                    </p>

                </div>

            @break

            @case('Selesai')

                <div class="text-success">

                    <h6 class="fw-bold">
                        Surat Telah Selesai
                    </h6>

                    <p class="mb-0 text-muted">

                        Surat sudah selesai diproses dan
                        siap dicetak maupun diserahkan.

                    </p>

                </div>

            @break

            @case('Ditolak')

                <div class="text-danger">

                    <h6 class="fw-bold">
                        Permohonan Ditolak
                    </h6>

                    <p class="mb-0 text-muted">

                        Permohonan tidak dapat diproses.
                        Silakan lihat catatan petugas.

                    </p>

                </div>

            @break

        @endswitch

    </div>

</div>