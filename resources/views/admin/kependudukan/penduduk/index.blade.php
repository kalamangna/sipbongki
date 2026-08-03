@extends('layouts.admin')

@section('title', 'Data Penduduk')

@section('content')
<div class="d-flex flex-column gap-4">

    {{-- HEADER HALAMAN --}}
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-1 text-dark">Data Penduduk</h4>
            <p class="text-muted mb-0 small">Kelola seluruh data kependudukan Kelurahan Bongki</p>
        </div>

        <a href="{{ route('admin.penduduk.create') }}" class="btn btn-success rounded-3 px-3 shadow-xs">
            <i class="fa-solid fa-circle-plus me-1"></i> Tambah Penduduk
        </a>
    </div>

    {{-- FILTER & TABLE CARD --}}
    <div class="card border-0 shadow-sm rounded-4">
        {{-- FILTER FORM --}}
        <div class="card-header bg-white border-0 pt-4 px-4 pb-3">
            <form method="GET" action="{{ route('admin.penduduk.index') }}">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" name="search" value="{{ $search }}" class="form-control bg-light border-start-0 shadow-none" placeholder="Cari Nama / NIK...">
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <select name="lingkungan" class="form-select bg-light shadow-none">
                            <option value="">Semua Lingkungan</option>
                            @foreach($lingkungans as $item)
                                <option value="{{ $item->id }}" {{ $lingkungan == $item->id ? 'selected':'' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-4">
                        <select name="jenis_kelamin" class="form-select bg-light shadow-none">
                            <option value="">Semua JK</option>
                            <option value="L" {{ $jenis_kelamin == 'L' ? 'selected':'' }}>Laki-laki</option>
                            <option value="P" {{ $jenis_kelamin == 'P' ? 'selected':'' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-4">
                        <select name="agama" class="form-select bg-light shadow-none">
                            <option value="">Semua Agama</option>
                            @foreach($agamas as $item)
                                <option value="{{ $item }}" {{ $agama == $item ? 'selected':'' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-success flex-fill rounded-3">
                            <i class="fa-solid fa-filter me-1"></i> Filter
                        </button>

                        @if($search || $lingkungan || $jenis_kelamin || $agama)
                            <a href="{{ route('admin.penduduk.index') }}" class="btn btn-outline-secondary rounded-3" title="Reset Filter">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>   

        {{-- DATA TABLE --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" width="60">No</th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort'=>'nik','direction'=>$direction=='asc'?'desc':'asc']) }}" class="text-decoration-none text-dark fw-bold">
                                    NIK <i class="fa-solid fa-sort ms-1 text-muted"></i>
                                </a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort'=>'nama_lengkap','direction'=>$direction=='asc'?'desc':'asc']) }}" class="text-decoration-none text-dark fw-bold">
                                    Nama Lengkap <i class="fa-solid fa-sort ms-1 text-muted"></i>
                                </a>
                            </th>
                            <th>JK</th>
                            <th>Lingkungan</th>
                            <th>Agama</th>
                            <th>Status</th>
                            <th class="pe-4 text-center" width="140">Aksi</th>
                        </tr>
                    </thead>  
                    <tbody>
                        @forelse($penduduks as $penduduk)
                            <tr>
                                <td class="ps-4 text-muted small">{{ $penduduks->firstItem() + $loop->index }}</td>
                                <td class="fw-semibold text-dark">{{ $penduduk->nik }}</td>
                                <td class="fw-bold text-dark">{{ $penduduk->nama_lengkap }}</td>
                                <td>
                                    <span class="badge {{ $penduduk->jenis_kelamin == 'L' ? 'bg-primary-subtle text-primary border border-primary-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle' }} rounded-pill">
                                        {{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </td>
                                <td>{{ $penduduk->lingkungan->nama ?? '-' }}</td>
                                <td>{{ $penduduk->agama ?? '-' }}</td>
                                <td>
                                    @if($penduduk->aktif)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.penduduk.show', $penduduk) }}" class="btn btn-sm btn-light border text-primary rounded-2" title="Detail">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.penduduk.edit', $penduduk) }}" class="btn btn-sm btn-light border text-warning rounded-2" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.penduduk.destroy', $penduduk) }}" method="POST" class="d-inline mb-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger rounded-2" title="Hapus" onclick="return confirm('Yakin ingin menghapus data penduduk ini?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>     
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-users fs-1 d-block mb-3 opacity-25"></i>
                                    <span>Belum ada data penduduk yang ditemukan.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($penduduks->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $penduduks->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>
@endsection