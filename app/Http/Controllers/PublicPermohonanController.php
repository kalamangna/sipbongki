<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\JenisSurat;
use App\Models\PermohonanSurat;
use App\Models\Lingkungan;
use App\Models\KartuKeluarga;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicPermohonanController extends Controller
{
    public function create(\Illuminate\Http\Request $request)
    {
        $jenisSurats = JenisSurat::where('aktif', true)
            ->orderBy('nama')
            ->get();

        $selected = $request->old('jenis_surat_id') ?: $request->query('jenis') ?: ($jenisSurats->first()?->id ?? null);
        $selectedJenisSurat = $jenisSurats->firstWhere('id', $selected);

        $lingkungans = Lingkungan::orderBy('nama')->get();
        $kartuKeluargas = KartuKeluarga::orderBy('no_kk')->get();

        return view('public.permohonan.create', compact('jenisSurats', 'selected', 'selectedJenisSurat', 'lingkungans', 'kartuKeluargas'));
    }

    public function lookup(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:30'],
            'jenis_surat_id' => ['required', 'exists:jenis_surats,id'],
        ]);

        $jenis = JenisSurat::findOrFail($validated['jenis_surat_id']);

        $penduduk = Penduduk::where('nik', $validated['nik'])
                            ->where('aktif', true)
                            ->first();

        if (! $penduduk) {
            return response()->json([
                'found' => false,
            ]);
        }

        return response()->json([
            'found' => true,
            'dob_match' => true,
            'penduduk' => [
                'id' => $penduduk->id,
                'nik' => $penduduk->nik,
                'nama_lengkap' => $penduduk->nama_lengkap,
                'tempat_lahir' => $penduduk->tempat_lahir,
                'tanggal_lahir' => $penduduk->tanggal_lahir ? Carbon::parse($penduduk->tanggal_lahir)->translatedFormat('d F Y') : '-',
                'tanggal_lahir_raw' => $penduduk->tanggal_lahir,
                'jenis_kelamin' => $penduduk->jenis_kelamin,
                'agama' => $penduduk->agama,
                'pekerjaan' => $penduduk->pekerjaan,
                'alamat' => $penduduk->alamat,
                'rt' => $penduduk->rt,
                'rw' => $penduduk->rw,
                'telepon' => $penduduk->telepon,
                'lingkungan_id' => $penduduk->lingkungan_id,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $existingIdentity = [
            'existing_penduduk_id' => $request->input('existing_penduduk_id'),
            'existing_nik' => $request->input('existing_nik'),
            'existing_nama_lengkap' => $request->input('existing_nama_lengkap'),
            'existing_tempat_lahir' => $request->input('existing_tempat_lahir'),
            'existing_tanggal_lahir' => $request->input('existing_tanggal_lahir'),
            'existing_jenis_kelamin' => $request->input('existing_jenis_kelamin'),
            'existing_agama' => $request->input('existing_agama'),
            'existing_pekerjaan' => $request->input('existing_pekerjaan'),
            'existing_telepon' => $request->input('existing_telepon'),
            'existing_alamat' => $request->input('existing_alamat'),
            'existing_rt' => $request->input('existing_rt'),
            'existing_rw' => $request->input('existing_rw'),
            'existing_lingkungan_id' => $request->input('existing_lingkungan_id'),
        ];

        $hasExistingIdentity = collect($existingIdentity)->some(fn ($value) => filled($value));
        if ($hasExistingIdentity) {
            $request->merge([
                'nik' => $request->input('nik') ?: $request->input('existing_nik'),
                'nama_lengkap' => $request->input('nama_lengkap') ?: $request->input('existing_nama_lengkap'),
                'tempat_lahir' => $request->input('tempat_lahir') ?: $request->input('existing_tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir') ?: $request->input('existing_tanggal_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin') ?: $request->input('existing_jenis_kelamin'),
                'agama' => $request->input('agama') ?: $request->input('existing_agama'),
                'pekerjaan' => $request->input('pekerjaan') ?: $request->input('existing_pekerjaan'),
                'telepon' => $request->input('telepon') ?: $request->input('existing_telepon'),
                'alamat' => $request->input('alamat') ?: $request->input('existing_alamat'),
                'alamat_asal' => $request->input('alamat_asal') ?: $request->input('existing_alamat'),
                'rt' => $request->input('rt') ?: $request->input('existing_rt'),
                'rw' => $request->input('rw') ?: $request->input('existing_rw'),
                'lingkungan_id' => $request->input('lingkungan_id') ?: $request->input('existing_lingkungan_id'),
            ]);
        }

        $validated = $request->validate([
            'nik' => ['nullable', 'digits:16'],
            'no_kk' => ['nullable', 'digits:16'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'jenis_surat_id' => ['required', 'exists:jenis_surats,id'],
            'keperluan' => ['required', 'string', 'max:1000'],
            'nama_lengkap' => ['nullable', 'string', 'max:150'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'agama' => ['nullable', 'string', 'max:50'],
            'pekerjaan' => ['nullable', 'string', 'max:100'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'alamat_asal' => ['nullable', 'string', 'max:500'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'lama_tinggal' => ['nullable', 'string', 'max:100'],
            'status_tempat_tinggal' => ['nullable', 'string', 'max:100'],
            'lingkungan_id' => ['nullable', 'exists:lingkungans,id'],
            'kartu_keluarga_id' => ['nullable', 'exists:kartu_keluargas,id'],
            'hubungan_keluarga' => ['nullable', 'string', 'max:100'],
            'status_perkawinan' => ['nullable', 'string', 'max:50'],
            'pendidikan' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
            'aktif' => ['nullable', 'in:0,1'],
            'dokumen_ktp' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'dokumen_kk' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'dokumen_surat_pengantar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'dokumen_tempat_usaha' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $jenis = JenisSurat::findOrFail($validated['jenis_surat_id']);
        $isDomisili = $this->isDomisiliJenisSurat($jenis);
        $isUsaha = $jenis->isUsaha();

        $penduduk = null;
        $dataSurat = [];

        if ($isDomisili) {
            $request->merge([
                'alamat_asal' => $request->input('alamat_asal') ?: $request->input('alamat') ?: '-',
                'alamat' => $request->input('alamat_domisili') ?: $request->input('alamat'),
                'rt' => $request->input('rt_domisili') ?: $request->input('rt'),
                'rw' => $request->input('rw_domisili') ?: $request->input('rw'),
            ]);

            $request->validate([
                'nama_lengkap' => ['required', 'string', 'max:150'],
                'nik' => ['required', 'digits:16'],
                'no_kk' => ['nullable', 'digits:16'],
                'tempat_lahir' => ['required', 'string', 'max:100'],
                'tanggal_lahir' => ['required', 'date'],
                'jenis_kelamin' => ['required', 'in:L,P'],
                'agama' => ['nullable', 'string', 'max:50'],
                'pekerjaan' => ['required', 'string', 'max:100'],
                'telepon' => ['nullable', 'string', 'max:30'],
                'rt' => ['nullable', 'string', 'max:10'],
                'rw' => ['nullable', 'string', 'max:10'],
                'lama_tinggal' => ['required', 'string', 'max:100'],
                'status_tempat_tinggal' => ['required', 'string', 'max:100'],
                'alamat_asal' => ['nullable', 'string', 'max:500'],
                'alamat' => ['required', 'string', 'max:500'],
                'dokumen_ktp' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
                'dokumen_kk' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
                'dokumen_surat_pengantar' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            ]);

            $dataSurat = [
                'nama_lengkap' => $request->nama_lengkap,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'telepon' => $request->telepon,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'lama_tinggal' => $request->lama_tinggal,
                'status_tempat_tinggal' => $request->status_tempat_tinggal,
                'alamat_asal' => $request->alamat_asal,
                'alamat' => $request->alamat,
            ];

            if ($request->hasFile('dokumen_ktp')) {
                $dataSurat['dokumen_ktp'] = $request->file('dokumen_ktp')->store('permohonan-surat/dokumen', 'public');
            }
            if ($request->hasFile('dokumen_kk')) {
                $dataSurat['dokumen_kk'] = $request->file('dokumen_kk')->store('permohonan-surat/dokumen', 'public');
            }
            if ($request->hasFile('dokumen_surat_pengantar')) {
                $dataSurat['dokumen_surat_pengantar'] = $request->file('dokumen_surat_pengantar')->store('permohonan-surat/dokumen', 'public');
            }
        } elseif ($isUsaha) {
                        $request->validate([
                'nama_usaha' => ['required', 'string', 'max:150'],
                'jenis_usaha' => ['required', 'string', 'max:150'],
                'alamat_usaha' => ['nullable', 'string', 'max:255'],
                'lama_usaha' => ['nullable', 'string', 'max:100'],
                'nama_lengkap' => ['required', 'string', 'max:150'],
                'nik' => ['nullable', 'digits:16'],
                'no_kk' => ['nullable', 'digits:16'],
                'tempat_lahir' => ['required', 'string', 'max:100'],
                'tanggal_lahir' => ['required', 'date'],
                'jenis_kelamin' => ['required', 'in:L,P'],
                'agama' => ['nullable', 'string', 'max:50'],
                'pekerjaan' => ['required', 'string', 'max:100'],
                'telepon' => ['nullable', 'string', 'max:30'],
                'alamat' => ['nullable', 'string', 'max:500'],
                'rt' => ['nullable', 'string', 'max:5'],
                'rw' => ['nullable', 'string', 'max:5'],
                'lingkungan_id' => ['nullable', 'exists:lingkungans,id'],
                'kartu_keluarga_id' => ['nullable', 'exists:kartu_keluargas,id'],
                'hubungan_keluarga' => ['nullable', 'string', 'max:100'],
                'status_perkawinan' => ['nullable', 'string', 'max:50'],
                'pendidikan' => ['nullable', 'string', 'max:100'],
                'email' => ['nullable', 'email', 'max:255'],
                'status_validasi_alamat' => ['nullable', 'string', 'max:50'],
                'aktif' => ['nullable', 'in:0,1'],
            ]);

            if (empty($validated['nik'])) {
                return back()->withErrors([
                    'nik' => 'NIK wajib untuk layanan Surat Keterangan Usaha.'
                ])->withInput();
            }

            $penduduk = Penduduk::where('nik', $validated['nik'])->first();

            if (! $penduduk) {
                $dataSurat = [
                    'nama_usaha' => $request->nama_usaha,
                    'jenis_usaha' => $request->jenis_usaha,
                    'alamat_usaha' => $request->alamat_usaha,
                    'lama_usaha' => $request->lama_usaha,
                    'nama_pemilik' => $request->input('nama_lengkap'),
                    'nik' => $validated['nik'],
                    'no_kk' => $request->no_kk,
                    'telepon' => $request->telepon,

                    'manual_nama_lengkap' => $request->input('nama_lengkap'),
                    'manual_nik' => $validated['nik'],
                    'manual_no_kk' => $request->no_kk,
                    'manual_tempat_lahir' => $request->input('tempat_lahir'),
                    'manual_tanggal_lahir' => $request->input('tanggal_lahir'),
                    'manual_jenis_kelamin' => $request->input('jenis_kelamin'),
                    'manual_agama' => $request->input('agama'),
                    'manual_pekerjaan' => $request->input('pekerjaan'),
                    'manual_alamat' => $request->input('alamat'),
                    'manual_telepon' => $request->telepon,
                    'manual_rt' => $request->input('rt'),
                    'manual_rw' => $request->input('rw'),
                ];
            } else {
                $dataSurat = [
                    'nama_usaha' => $request->nama_usaha,
                    'jenis_usaha' => $request->jenis_usaha,
                    'alamat_usaha' => $request->alamat_usaha,
                    'lama_usaha' => $request->lama_usaha,
                    'nama_pemilik' => $penduduk->nama_lengkap,
                    'nik' => $penduduk->nik,
                    'telepon' => $request->telepon ?? $penduduk->telepon,
                ];
            }

            if ($request->hasFile('dokumen_ktp')) {
                $dataSurat['dokumen_ktp'] = $request->file('dokumen_ktp')->store('permohonan-surat/dokumen', 'public');
            }
            if ($request->hasFile('dokumen_kk')) {
                $dataSurat['dokumen_kk'] = $request->file('dokumen_kk')->store('permohonan-surat/dokumen', 'public');
            }
            if ($request->hasFile('dokumen_surat_pengantar')) {
                $dataSurat['dokumen_surat_pengantar'] = $request->file('dokumen_surat_pengantar')->store('permohonan-surat/dokumen', 'public');
            }
            if ($request->hasFile('dokumen_tempat_usaha')) {
                $dataSurat['dokumen_tempat_usaha'] = $request->file('dokumen_tempat_usaha')->store('permohonan-surat/dokumen', 'public');
            }
        } else {
            if (empty($validated['nik'])) {
                return back()->withErrors([
                    'nik' => 'NIK wajib untuk layanan ini. Jika Anda tidak punya NIK, silakan gunakan layanan Keterangan Domisili.'
                ])->withInput();
            }

            $penduduk = Penduduk::where('nik', $validated['nik'])->first();

            if (!$penduduk) {
                $request->validate([
                    'nama_lengkap' => ['required', 'string', 'max:255'],
                    'tempat_lahir' => ['required', 'string', 'max:100'],
                    'tanggal_lahir' => ['required', 'date'],
                    'jenis_kelamin' => ['required', 'in:L,P'],
                    'alamat' => ['required', 'string'],
                    'rt' => ['nullable', 'string', 'max:10'],
                    'rw' => ['nullable', 'string', 'max:10'],
                    'lingkungan_id' => ['nullable', 'exists:lingkungans,id'],
                    'telepon' => ['nullable', 'string', 'max:30'],
                    'kartu_keluarga_id' => ['nullable', 'exists:kartu_keluargas,id'],
                    'hubungan_keluarga' => ['nullable', 'string', 'max:100'],
                    'agama' => ['nullable', 'string', 'max:50'],
                    'status_perkawinan' => ['nullable', 'string', 'max:50'],
                    'pendidikan' => ['nullable', 'string', 'max:100'],
                    'pekerjaan' => ['nullable', 'string', 'max:100'],
                    'email' => ['nullable', 'email', 'max:255'],
                    'dokumen_ktp' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
                    'dokumen_kk' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
                    'dokumen_surat_pengantar' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
                ]);

                $dataSurat = [
                    'nama_pemohon' => $request->input('nama_lengkap'),
                    'nik' => $validated['nik'],
                    'no_kk' => $request->no_kk,
                    'telepon' => $validated['telepon'] ?? null,
                    'alamat' => $request->input('alamat'),

                    'manual_nama_lengkap' => $request->input('nama_lengkap'),
                    'manual_nik' => $validated['nik'],
                    'manual_no_kk' => $request->no_kk,
                    'manual_tempat_lahir' => $request->input('tempat_lahir'),
                    'manual_tanggal_lahir' => $request->input('tanggal_lahir'),
                    'manual_jenis_kelamin' => $request->input('jenis_kelamin'),
                    'manual_agama' => $request->input('agama'),
                    'manual_pekerjaan' => $request->input('pekerjaan'),
                    'manual_alamat' => $request->input('alamat'),
                    'manual_rt' => $request->input('rt'),
                    'manual_rw' => $request->input('rw'),
                ];
            } else {
                $dataSurat = [
                    'nama_pemohon' => $penduduk->nama_lengkap,
                    'telepon' => $validated['telepon'] ?? null,
                    'alamat' => $request->input('alamat'),
                ];
            }

            if ($request->hasFile('dokumen_ktp')) {
                $dataSurat['dokumen_ktp'] = $request->file('dokumen_ktp')->store('permohonan-surat/dokumen', 'public');
            }
            if ($request->hasFile('dokumen_kk')) {
                $dataSurat['dokumen_kk'] = $request->file('dokumen_kk')->store('permohonan-surat/dokumen', 'public');
            }
            if ($request->hasFile('dokumen_surat_pengantar')) {
                $dataSurat['dokumen_surat_pengantar'] = $request->file('dokumen_surat_pengantar')->store('permohonan-surat/dokumen', 'public');
            }
        }

        // Hanya buat data Penduduk baru jika pemilih mengonfirmasi sebagai "Penduduk Bongki"
        if (!$penduduk && !empty($validated['nik']) && $request->input('jenis_pemohon') === 'bongki') {
            $penduduk = Penduduk::create([
                'nik' => $validated['nik'],
                'nama_lengkap' => $request->input('nama_lengkap'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'agama' => $request->input('agama'),
                'pekerjaan' => $request->input('pekerjaan'),
                'alamat' => $request->input('alamat'),
                'rt' => $request->input('rt'),
                'rw' => $request->input('rw'),
                'telepon' => $request->input('telepon'),
                'email' => $request->input('email'),
                'lingkungan_id' => $request->input('lingkungan_id'),
                'status_perkawinan' => $request->input('status_perkawinan'),
                'pendidikan' => $request->input('pendidikan'),
                'hubungan_keluarga' => $request->input('hubungan_keluarga'),
                'aktif' => false,
            ]);
        }

        $permohonan = PermohonanSurat::create([
            'nomor_permohonan' => 'PMH-' . now()->format('YmdHis'),
            'penduduk_id' => $penduduk?->id,
            'jenis_surat_id' => $validated['jenis_surat_id'],
            'keperluan' => $validated['keperluan'],
            'status' => 'Menunggu',
            'tanggal_permohonan' => now(),
            'data_surat' => $dataSurat,
        ]);

        return redirect()
            ->route('permohonan.show', $permohonan)
            ->with('success', 'Permohonan Anda berhasil dikirim. Nomor: ' . $permohonan->nomor_permohonan)
            ->with('permohonan_page_mode', 'submitted');
    }

    public function show(PermohonanSurat $permohonanSurat)
    {
        $permohonanSurat->load(['jenisSurat']);

        $pageMode = session('permohonan_page_mode', 'submitted');

        return view('public.permohonan.show', compact('permohonanSurat', 'pageMode'));
    }

    /**
     * Cek status permohonan publik berdasarkan nomor permohonan.
     */
    public function checkStatus(Request $request)
    {
        $nomor = trim($request->query('nomor', ''));

        if (empty($nomor)) {
            return back()->with('error', 'Masukkan nomor permohonan.');
        }

        $permohonan = PermohonanSurat::where('nomor_permohonan', $nomor)->first();

        if ($permohonan) {
            return redirect()
                ->route('permohonan.show', $permohonan)
                ->with('permohonan_page_mode', 'status');
        }

        return back()->with('error', 'Permohonan dengan nomor tersebut tidak ditemukan.');
    }

    private function isDomisiliJenisSurat(JenisSurat $jenisSurat): bool
    {
        return $jenisSurat->isDomisili();
    }
}
