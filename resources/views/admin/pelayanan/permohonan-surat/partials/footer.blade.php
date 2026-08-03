<div class="card shadow-sm border-0 mt-4">

    <div class="card-body">

        <div class="d-flex justify-content-between flex-wrap gap-2">

            <a
                href="{{ route('admin.permohonan-surat.index') }}"
                class="btn btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>

                Kembali

            </a>

            <div class="d-flex gap-2">

                <a
                    href="{{ route('admin.permohonan-surat.edit',$permohonanSurat) }}"
                    class="btn btn-warning">

                    <i class="fa-solid fa-pen-square"></i>

                    Edit

                </a>

                @if($permohonanSurat->status=='Selesai')

                    <button
                        type="button"
                        class="btn btn-success"
                        disabled>

                        <i class="fa-solid fa-print"></i>

                        Cetak Surat

                    </button>

                @endif

            </div>

        </div>

    </div>

</div>