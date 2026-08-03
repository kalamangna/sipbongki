<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white d-flex align-items-center">

        <i class="fa-solid fa-id-card text-primary fs-4 me-2"></i>

        <div>

            <h5 class="mb-0 fw-semibold">
                Data Pemohon
            </h5>

            <small class="text-muted">
                Informasi identitas pemohon surat
            </small>

        </div>

    </div>

    <div class="card-body">

        <div class="row gy-3">

            <div class="col-md-6">

                <small class="text-muted d-block">
                    Nama Lengkap
                </small>

                <div class="fw-semibold fs-6">
                    {{ $permohonanSurat->penduduk->nama_lengkap }}
                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block">
                    NIK
                </small>

                <div class="fw-semibold">
                    {{ $permohonanSurat->penduduk->nik }}
                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block">
                    Nomor KK
                </small>

                <div class="fw-semibold">
                    {{ $permohonanSurat->penduduk->no_kk }}
                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block">
                    Jenis Kelamin
                </small>

                <div>
                    {{ $permohonanSurat->penduduk->jenis_kelamin }}
                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block">
                    Tempat Lahir
                </small>

                <div>
                    {{ $permohonanSurat->penduduk->tempat_lahir }}
                </div>

            </div>

            <div class="col-md-6">

                <small class="text-muted d-block">
                    Tanggal Lahir
                </small>

                <div>
                    {{ $permohonanSurat->penduduk->tanggal_lahir->translatedFormat('d F Y') }}
                </div>

            </div>

            <div class="col-12">

                <small class="text-muted d-block">
                    Alamat
                </small>

                <div class="border rounded-3 p-3 bg-light">

                    {{ $permohonanSurat->penduduk->alamat }}

                </div>

            </div>

        </div>

    </div>

</div>