@extends('layouts.admin')

@section('title', 'Riwayat Pelayanan')

@section('content')

<div class="container-fluid">

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

        <div class="px-6 py-4 border-b border-slate-200 bg-white">
            <div class="flex justify-between items-center">
                <div>
                    <h5 class="mb-0">Riwayat Pelayanan</h5>
                    <small class="text-slate-500">Semua riwayat pelayanan permohonan</small>
                </div>
            </div>
        </div>

        <div class="p-6 p-0">

            <div class="overflow-x-auto w-full">

                <table class="w-full text-left border-collapse text-sm table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="70">No</th>

                            <th>No. Permohonan</th>

                            <th>Pemohon</th>

                            <th>Jenis Surat</th>

                            <th width="120" class="text-center">
                                Status
                            </th>

                            <th width="150">
                                Tanggal Selesai
                            </th>

                            <th width="200" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($riwayats as $item)

                            <tr>

                                <td>
                                    {{ $riwayats->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $item->nomor_permohonan }}
                                </td>

                                <td>
                                    {{ optional($item->penduduk)->nama_lengkap ?? data_get($item->data_surat, 'nama_lengkap') ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->jenisSurat->nama ?? '-' }}
                                </td>

                                <td class="text-center">

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ $item->status_badge_class }}">
                                        {{ $item->status }}
                                    </span>

                                </td>

                                <td>

                                    {{ $item->tanggal_selesai
                                        ? \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y')
                                        : '-'
                                    }}

                                </td>

                                <td class="text-center">

                                    <div class="action-buttons">

                                        {{-- Preview --}}
                                        <a
    href="{{ route('admin.permohonan-surat.preview', $item) }}?from=riwayat"
    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
    title="Preview Surat">

    <i class="bi bi-eye"></i>

</a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-8">

                                    <i class="bi bi-clock-history fs-1 text-slate-500 d-block mb-4"></i>

                                    <span class="text-slate-500">

                                        Belum ada riwayat pelayanan.

                                    </span>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        @if($riwayats->hasPages())

            <div class="px-6 py-4 border-t border-slate-200 bg-white">

                {{ $riwayats->links() }}

            </div>

        @endif

    </div>

</div>

@endsection