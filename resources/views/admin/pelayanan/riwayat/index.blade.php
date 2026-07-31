@extends('layouts.admin')

@section('title', 'Riwayat Pelayanan')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

          
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

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
                                    {{ $item->penduduk->nama_lengkap ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->jenisSurat->nama ?? '-' }}
                                </td>

                                <td class="text-center">

                                    <span class="badge bg-{{ $item->status_badge_class }}">
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
    href="{{ route('admin.permohonan-surat.preview', $item) }}"
    class="btn btn-info btn-sm"
    title="Preview Surat">

    <i class="bi bi-eye"></i>

</a>

                                        {{-- Cetak --}}
                                        <a
                                            href="{{ route('admin.permohonan-surat.print', $item) }}"
                                            class="btn btn-primary btn-sm"
                                            target="_blank"
                                            title="Cetak Surat">

                                            <i class="bi bi-printer"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-5">

                                    <i class="bi bi-clock-history fs-1 text-muted d-block mb-3"></i>

                                    <span class="text-muted">

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

            <div class="card-footer bg-white">

                {{ $riwayats->links() }}

            </div>

        @endif

    </div>

</div>

@endsection