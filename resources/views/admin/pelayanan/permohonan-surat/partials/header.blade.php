<div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0 mb-6">

    <div class="p-6">

        <div class="flex flex-wrap -mx-3 items-center">

            <div class="w-full lg:w-2/3 px-3">

                <h3 class="font-bold mb-2">

                    Detail Permohonan Surat

                </h3>

                <small class="text-slate-500">

                    Nomor Permohonan

                </small>

                <h5 class="fw-semibold text-primary mt-2">

                    {{ $permohonanSurat->nomor_permohonan }}

                </h5>

            </div>

            <div class="w-full lg:w-1/3 px-3 text-lg-end mt-3 mt-lg-0">

                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ $permohonanSurat->status_badge_class }} fs-6 px-4 py-3 rounded-pill">

                    {{ strtoupper($permohonanSurat->status) }}

                </span>

            </div>

        </div>

    </div>

</div>