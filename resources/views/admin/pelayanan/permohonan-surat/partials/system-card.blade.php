<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex align-items-center">

        <i class="bi bi-info-circle text-primary fs-4 me-2"></i>

        <div>

            <h5 class="mb-0 fw-semibold">
                Informasi Sistem
            </h5>

            <small class="text-muted">
                Metadata permohonan surat
            </small>

        </div>

    </div>

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">

            <div>

                <small class="text-muted d-block">
                    ID Permohonan
                </small>

                <strong>
                    #{{ $permohonanSurat->id }}
                </strong>

            </div>

            <i class="bi bi-hash text-primary fs-4"></i>

        </div>

        <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

            <div>

                <small class="text-muted d-block">
                    Dibuat
                </small>

                <strong>

                    {{ $permohonanSurat->created_at->translatedFormat('d F Y') }}

                </strong>

                <br>

                <small class="text-secondary">

                    {{ $permohonanSurat->created_at->format('H:i') }} WITA

                </small>

            </div>

            <i class="bi bi-calendar-plus text-success fs-4"></i>

        </div>

        <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

            <div>

                <small class="text-muted d-block">
                    Terakhir Diubah
                </small>

                <strong>

                    {{ $permohonanSurat->updated_at->translatedFormat('d F Y') }}

                </strong>

                <br>

                <small class="text-secondary">

                    {{ $permohonanSurat->updated_at->format('H:i') }} WITA

                </small>

            </div>

            <i class="bi bi-clock-history text-warning fs-4"></i>

        </div>

        @if($permohonanSurat->tanggal_selesai)

        <div class="d-flex justify-content-between align-items-center pt-3">

            <div>

                <small class="text-muted d-block">
                    Tanggal Selesai
                </small>

                <strong>

                    {{ $permohonanSurat->tanggal_selesai->translatedFormat('d F Y') }}

                </strong>

            </div>

            <i class="bi bi-check-circle-fill text-success fs-4"></i>

        </div>

        @endif

    </div>

</div>