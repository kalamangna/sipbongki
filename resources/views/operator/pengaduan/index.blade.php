@extends('layouts.operator')

@section('title', 'Data Pengaduan')

@section('subtitle', 'Daftar pengaduan masyarakat Kelurahan Bongki')

@section('content')

<div class="dashboard-container">
    <div class="card dashboard-card">
        <div class="card-header d-flex justify-content-start align-items-center gap-3 border-0">
            <div>
                
                <small class="text-muted">Daftar seluruh pengaduan yang dikirim oleh masyarakat Kelurahan Bongki.</small>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="70">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Catatan Petugas</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduans as $pengaduan)
                            <tr>
                                <td>{{ $pengaduans->firstItem() + $loop->index }}</td>
                                <td>{{ $pengaduan->kode }}</td>
                                <td>{{ $pengaduan->nama }}</td>
                                <td>{{ $pengaduan->telepon }}</td>
                                <td>{{ $pengaduan->kategori }}</td>
                                <td>
                                    @if($pengaduan->status == 'Baru')
                                        <span class="badge bg-secondary">Baru</span>
                                    @elseif($pengaduan->status == 'Diproses')
                                        <span class="badge bg-warning">Diproses</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($pengaduan->catatan))
                                        <span class="text-muted small">
                                            {{ \Illuminate\Support\Str::limit($pengaduan->catatan, 50) }}
                                        </span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('operator.pengaduan.show', $pengaduan) }}" class="btn btn-sm btn-info text-white">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <form action="{{ route('operator.pengaduan.destroy', $pengaduan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    Belum ada pengaduan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($pengaduans->hasPages())
            <div class="card-footer border-0">
                {{ $pengaduans->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>

@endsection
