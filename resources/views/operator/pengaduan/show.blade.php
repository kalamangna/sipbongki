@extends('layouts.operator')

@section('title', 'Detail Pengaduan')

@section('subtitle', 'Informasi lengkap pengaduan masyarakat')

@section('content')

<div class="dashboard-container">
    <div class="card dashboard-card">
        <div class="card-header d-flex justify-content-start align-items-center gap-3 border-0">
            <div>
                <h5 class="fw-bold mb-1">Detail Pengaduan</h5>
                <small class="text-muted">Tinjau detail dan ubah status pengaduan.</small>
            </div>
            <a href="{{ route('operator.pengaduan.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>

        <div class="card-body">
            <div class="row gy-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="mb-3">Informasi Pengaduan</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="220">Kode Pengaduan</th>
                                    <td>{{ $pengaduan->kode }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $pengaduan->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIK Pelapor</th>
                                    <td>{{ $pengaduan->nik_pelapor ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>{{ $pengaduan->telepon }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $pengaduan->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Catatan Petugas</th>
                                    <td>{{ $pengaduan->catatan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>{{ $pengaduan->kategori }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>{{ $pengaduan->lokasi }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ $pengaduan->created_at->format('d F Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $pengaduan->status }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="mb-3">Uraian Pengaduan</h5>
                            <p>{!! nl2br(e($pengaduan->uraian)) !!}</p>
                        </div>
                    </div>
                </div>

                @if($pengaduan->foto)
                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="mb-3">Bukti Foto</h5>
                                <img src="{{ asset('storage/'.$pengaduan->foto) }}" alt="Foto Pengaduan" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="mb-3">Perbarui Status</h5>
                            <form action="{{ route('operator.pengaduan.update', $pengaduan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Baru" @selected($pengaduan->status == 'Baru')>Baru</option>
                                        <option value="Diproses" @selected($pengaduan->status == 'Diproses')>Diproses</option>
                                        <option value="Selesai" @selected($pengaduan->status == 'Selesai')>Selesai</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Catatan</label>
                                    <textarea name="catatan" class="form-control" rows="4">{{ old('catatan', $pengaduan->catatan) }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
