@extends('layouts.admin')

@section('title', 'Data Pengaduan')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            
            <p class="text-muted mb-0">
                Daftar seluruh pengaduan yang dikirim oleh masyarakat Kelurahan Bongki.
            </p>

        </div>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="60">No</th>

                            <th>Kode</th>

                            <th>Nama Pelapor</th>

                            <th>Kategori</th>

                            <th>Lokasi</th>

                            <th>Status</th>

                            <th>Tanggal</th>

                            <th width="180" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($pengaduans as $pengaduan)

                        <tr>

                            <td>
                                {{ $pengaduans->firstItem() + $loop->index }}
                            </td>

                            <td>

                                <span class="fw-semibold">
                                    {{ $pengaduan->kode }}
                                </span>

                            </td>

                            <td>

                                <div class="fw-semibold">
                                    {{ $pengaduan->nama }}
                                </div>

                                <small class="text-muted">
                                    {{ $pengaduan->telepon }}
                                </small>

                            </td>

                            <td>

                                <span class="badge bg-light text-dark border">
                                    {{ $pengaduan->kategori }}
                                </span>

                            </td>

                            <td>

                                {{ \Illuminate\Support\Str::limit($pengaduan->lokasi,40) }}

                            </td>

                            <td>

                                @if($pengaduan->status == 'Baru')

                                    <span class="badge bg-danger">
                                        Baru
                                    </span>

                                @elseif($pengaduan->status == 'Diproses')

                                    <span class="badge bg-warning text-dark">
                                        Diproses
                                    </span>

                                @else

                                    <span class="badge bg-success">
                                        Selesai
                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $pengaduan->created_at->format('d M Y') }}

                                <br>

                                <small class="text-muted">
                                    {{ $pengaduan->created_at->format('H:i') }}
                                </small>

                            </td>

                <td class="text-center">

    <div class="d-flex justify-content-center gap-2">

        <a
            href="{{ route('admin.pengaduan.show',$pengaduan) }}"
            class="btn btn-primary btn-sm">

            <i class="bi bi-eye me-1"></i>
            Lihat

        </a>


        <form
            action="{{ route('admin.pengaduan.destroy',$pengaduan) }}"
            method="POST"
            onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger btn-sm">

                <i class="bi bi-trash me-1"></i>
                Hapus

            </button>

        </form>

    </div>

</td>     
                            

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-5">

                                <i class="bi bi-inbox display-4 d-block mb-3 text-secondary"></i>

                                <h5 class="mb-2">
                                    Belum Ada Pengaduan
                                </h5>

                                <p class="text-muted mb-0">
                                    Pengaduan dari masyarakat akan tampil di sini.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        @if($pengaduans->hasPages())

            <div class="card-footer bg-white">

                {{ $pengaduans->links('pagination::bootstrap-5') }}

            </div>

        @endif

    </div>

</div>

@endsection