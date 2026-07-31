<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white d-flex align-items-center">

        <i class="bi bi-envelope-paper text-primary fs-4 me-2"></i>

        <div>

            <h5 class="mb-0 fw-semibold">
                Informasi Permohonan
            </h5>

            <small class="text-muted">
                Informasi administrasi permohonan surat
            </small>

        </div>

    </div>

    <div class="card-body">

        <div class="row gy-4">

            <div class="col-md-6">

                <small class="text-muted d-block">
                    Nomor Permohonan
                </small>

                <div class="fw-semibold fs-6">
                    {{ $permohonanSurat->nomor_permohonan }}
                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block">
                    Nomor Surat
                </small>

                <div class="fw-semibold">

                    @if($permohonanSurat->nomor_surat)

                        {{ $permohonanSurat->nomor_surat }}

                    @else

                        <span class="text-muted">
                            Belum diterbitkan
                        </span>

                    @endif

                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block">
                    Jenis Surat
                </small>

                <div>
                    {{ $permohonanSurat->jenisSurat->nama }}
                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block">
                    Tanggal Permohonan
                </small>

                <div>
                    {{ $permohonanSurat->tanggal_permohonan->translatedFormat('d F Y') }}
                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block">
                    Pejabat Penandatangan
                </small>

                <div>

                    @if($permohonanSurat->penandatangan)

                        <strong>
                            {{ $permohonanSurat->penandatangan->nama_lengkap }}
                        </strong>

                        <br>

                        <small class="text-muted">

                            {{ $permohonanSurat->penandatangan->jabatan->nama }}

                        </small>

                    @else

                        <span class="text-danger">
                            Belum dipilih
                        </span>

                    @endif

                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block">
                    Status Permohonan
                </small>

                <span class="badge rounded-pill px-3 py-2 bg-{{ $permohonanSurat->status_badge_class }}">
                    {{ strtoupper($permohonanSurat->status) }}
                </span>

            </div>

        </div>

    </div>

</div>