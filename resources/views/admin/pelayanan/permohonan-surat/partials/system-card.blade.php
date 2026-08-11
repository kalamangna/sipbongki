<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

    <div class="px-6 py-4 border-b border-slate-200 bg-white border-0 request-detail-card-header">

        <div>

            <h5 class="mb-0 request-detail-card-title">
                Informasi Sistem
            </h5>

        </div>

    </div>

    <div class="p-6">

        <div class="flex justify-between items-center py-2 border-bottom">

            <div>

                <small class="text-slate-500 d-block">
                    ID Permohonan
                </small>

                <strong>
                    #{{ $permohonanSurat->id }}
                </strong>

            </div>

            <i class="bi bi-hash text-primary fs-4"></i>

        </div>

        <div class="flex justify-between items-center py-3 border-bottom">

            <div>

                <small class="text-slate-500 d-block">
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

        <div class="flex justify-between items-center py-3 border-bottom">

            <div>

                <small class="text-slate-500 d-block">
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

        <div class="flex justify-between items-center pt-3">

            <div>

                <small class="text-slate-500 d-block">
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