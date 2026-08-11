<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 request-detail-card-header">

        <div>

            <h5 class="mb-0 request-detail-card-title">
                Status Pelayanan
            </h5>

        </div>

    </div>

    <div class="p-6 text-center">

        @php

            $icon = match($permohonanSurat->status){

                'Menunggu' => 'bi-hourglass-split',

                'Diproses' => 'bi-arrow-repeat',

                'Selesai' => 'bi-check-circle-fill',

                'Ditolak' => 'bi-x-circle-fill',

                default => 'bi-question-circle',

            };

        @endphp

        <div class="mb-4">

            <i class="bi {{ $icon }} display-4 text-{{ $permohonanSurat->status_badge_class"></i>

        </div>

        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold rounded-pill px-4 py-3 fs-6 bg-{{ $permohonanSurat->status_badge_class }}">

            {{ strtoupper($permohonanSurat->status) }}

        </span>

        <hr class="my-4">

        @switch($permohonanSurat->status)

            @case('Menunggu')

                <div class="text-warning">

                    <h6 class="font-bold">
                        Menunggu Diproses
                    </h6>

                    <p class="mb-0 text-slate-500">

                        Permohonan telah diterima dan sedang
                        menunggu verifikasi petugas pelayanan.

                    </p>

                </div>

            @break

            @case('Diproses')

                <div class="text-info">

                    <h6 class="font-bold">
                        Sedang Diproses
                    </h6>

                    <p class="mb-0 text-slate-500">

                        Surat sedang diproses dan menunggu
                        penyelesaian administrasi.

                    </p>

                </div>

            @break

            @case('Selesai')

                <div class="text-success">

                    <h6 class="font-bold">
                        Surat Telah Selesai
                    </h6>

                    <p class="mb-0 text-slate-500">

                        Surat sudah selesai diproses dan
                        siap dicetak maupun diserahkan.

                    </p>

                </div>

            @break

            @case('Ditolak')

                <div class="text-danger">

                    <h6 class="font-bold">
                        Permohonan Ditolak
                    </h6>

                    <p class="mb-0 text-slate-500">

                        Permohonan tidak dapat diproses.
                        Silakan lihat catatan petugas.

                    </p>

                </div>

            @break

        @endswitch

    </div>

</div>