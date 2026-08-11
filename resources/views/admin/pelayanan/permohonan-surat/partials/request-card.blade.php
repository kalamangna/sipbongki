<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-white flex items-center">

        <i class="bi bi-envelope-paper text-primary fs-4 mr-2"></i>

        <div>

            <h5 class="mb-0 fw-semibold">
                Informasi Permohonan
            </h5>

            <small class="text-slate-500">
                Informasi administrasi permohonan surat
            </small>

        </div>

    </div>

    <div class="p-6">

        <div class="flex flex-wrap -mx-3 gy-4">

            <div class="w-full md:w-1/2 px-3">

                <small class="text-slate-500 d-block">
                    Nomor Permohonan
                </small>

                <div class="fw-semibold fs-6">
                    {{ $permohonanSurat->nomor_permohonan }}
                </div>

            </div>

            <div class="w-full md:w-1/2 px-3">

                <small class="text-slate-500 d-block">
                    Nomor Surat
                </small>

                <div class="fw-semibold">

                    @if($permohonanSurat->nomor_surat)

                        {{ $permohonanSurat->nomor_surat }}

                    @else

                        <span class="text-slate-500">
                            Belum diterbitkan
                        </span>

                    @endif

                </div>

            </div>

            <div class="w-full md:w-1/2 px-3">

                <small class="text-slate-500 d-block">
                    Jenis Surat
                </small>

                <div>
                    {{ $permohonanSurat->jenisSurat->nama }}
                </div>

            </div>

            <div class="w-full md:w-1/2 px-3">

                <small class="text-slate-500 d-block">
                    Tanggal Permohonan
                </small>

                <div>
                    {{ $permohonanSurat->tanggal_permohonan->translatedFormat('d F Y') }}
                </div>

            </div>

            <div class="w-full md:w-1/2 px-3">

                <small class="text-slate-500 d-block">
                    Pejabat Penandatangan
                </small>

                <div>

                    @if($permohonanSurat->penandatangan)

                        <strong>
                            {{ $permohonanSurat->penandatangan->nama_lengkap }}
                        </strong>

                        <br>

                        <small class="text-slate-500">

                            {{ $permohonanSurat->penandatangan->jabatan->nama }}

                        </small>

                    @else

                        <span class="text-danger">
                            Belum dipilih
                        </span>

                    @endif

                </div>

            </div>

            <div class="w-full md:w-1/2 px-3">

                <small class="text-slate-500 d-block">
                    Status Permohonan
                </small>

                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold rounded-pill px-3 py-2 bg-{{ $permohonanSurat->status_badge_class }}">
                    {{ strtoupper($permohonanSurat->status) }}
                </span>

            </div>

        </div>

    </div>

</div>