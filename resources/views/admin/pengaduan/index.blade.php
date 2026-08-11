@extends('layouts.admin')

@section('title', 'Data Pengaduan')

@section('content')

<div class="container-fluid">

    <div class="flex justify-between items-center mb-6">

        <div>

            
            <p class="text-slate-500 mb-0">
                Daftar seluruh pengaduan yang dikirim oleh masyarakat Kelurahan Bongki.
            </p>

        </div>

    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm border-0">

        <div class="p-6 p-0">

            <div class="overflow-x-auto w-full">

                <table class="w-full text-left border-collapse text-sm table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="60">No</th>

                            <th>Kode</th>

                            <th class="text-center">Nama Pelapor</th>

                            <th>Kategori</th>

                            <th>Lokasi</th>

                            <th>Status</th>

                            <th>Catatan Petugas</th>

                            <th class="text-center">Tanggal</th>

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

                                <span class="text-dark">
                                    {{ $pengaduan->kode }}
                                </span>

                            </td>

                            <td class="text-center">

                                <div>
                                    {{ $pengaduan->nama }}
                                </div>

                                <small class="text-slate-500">
                                    {{ $pengaduan->telepon }}
                                </small>

                            </td>

                            <td>

                                <span class="text-dark fw-normal">
                                    {{ $pengaduan->kategori }}
                                </span>

                            </td>

                            <td>

                                {{ \Illuminate\Support\Str::limit($pengaduan->lokasi,40) }}

                            </td>

                            <td>

                                @if($pengaduan->status == 'Baru')

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">
                                        Baru
                                    </span>

                                @elseif($pengaduan->status == 'Diproses')

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 text-dark">
                                        Diproses
                                    </span>

                                @else

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                        Selesai
                                    </span>

                                @endif

                            </td>

                            <td>
                                @if(!empty($pengaduan->catatan))
                                    <span class="text-slate-500 small">
                                        {{ 
                                            Illuminate\Support\Str::limit($pengaduan->catatan, 50)
                                        }}
                                    </span>
                                @else
                                    <span class="text-slate-500 small">-</span>
                                @endif
                            </td>

                            <td class="text-center">

                                {{ $pengaduan->created_at->format('d M Y') }}

                                <br>

                                <small class="text-slate-500">
                                    {{ $pengaduan->created_at->format('H:i') }}
                                </small>

                            </td>

                <td class="text-center">

    <div class="action-buttons">

        <a
            href="{{ route('admin.pengaduan.show',$pengaduan) }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-sky-600 text-white hover:bg-sky-700 shadow-sm !px-3 !py-1.5 !text-xs"
            title="Detail">

            <i class="bi bi-eye"></i>

        </a>

        {{-- Edit action removed per request --}}

        <form
            action="{{ route('admin.pengaduan.destroy',$pengaduan) }}"
            method="POST"
            class="d-inline mb-0"
            onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl transition-all bg-rose-600 text-white hover:bg-rose-700 shadow-sm !px-3 !py-1.5 !text-xs"
                title="Hapus">

                <i class="bi bi-trash"></i>

            </button>

        </form>

    </div>

</td>     
                            

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-8">

                                <i class="bi bi-inbox display-4 d-block mb-4 text-secondary"></i>

                                <h5 class="mb-2">
                                    Belum Ada Pengaduan
                                </h5>

                                <p class="text-slate-500 mb-0">
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

                <div class="px-6 py-4 border-t border-slate-200 bg-white border-0">

                {{ $pengaduans->links('pagination::bootstrap-5') }}

            </div>

        @endif

    </div>

</div>

@endsection