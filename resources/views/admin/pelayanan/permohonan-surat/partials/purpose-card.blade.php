<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="px-6 py-4 border-b border-slate-200 bg-white flex items-center">

        <i class="bi bi-chat-left-text text-primary fs-4 mr-2"></i>

        <div>

            <h5 class="mb-0 fw-semibold">
                Keperluan Permohonan
            </h5>

            <small class="text-slate-500">
                Tujuan dan alasan pengajuan surat
            </small>

        </div>

    </div>

    <div class="p-6">

        @if(!empty($permohonanSurat->keperluan))

            <div class="border rounded-3 bg-light p-4">

                <div class="lh-lg text-dark">

                    {!! nl2br(e($permohonanSurat->keperluan)) !!}

                </div>

            </div>

        @else

            <div class="text-center py-8">

                <i class="bi bi-file-earmark-text fs-1 text-secondary"></i>

                <h6 class="mt-3 mb-2">
                    Belum Ada Keperluan
                </h6>

                <p class="text-slate-500 mb-0">
                    Keperluan permohonan belum diisi oleh operator.
                </p>

            </div>

        @endif

    </div>

</div>