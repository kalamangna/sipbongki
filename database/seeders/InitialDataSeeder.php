<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lingkungan;
use App\Models\Jabatan;
use App\Models\JenisSurat;
use App\Models\Perangkat;
use App\Models\Penduduk;
use App\Models\KartuKeluarga;
use App\Models\WebsiteSetting;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\PermohonanSurat;
use App\Models\PermohonanSuratHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Disable Foreign Key Checks for clean seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
        |--------------------------------------------------------------------------
        | 1. Users
        |--------------------------------------------------------------------------
        */
        User::truncate();
        User::create([
            'id' => 1,
            'name' => 'Administrator',
            'username' => 'bongki',
            'email' => 'admin@sipbongki.go.id',
            'role' => 'admin',
            'password' => Hash::make('Bongki@7307'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | 2. Lingkungan
        |--------------------------------------------------------------------------
        */
        Lingkungan::truncate();
        $lingkungans = [
            ['id' => 1, 'kode' => 'L01', 'nama' => 'Lingkungan Paruntu', 'keterangan' => 'Lingkungan Paruntu Kelurahan Bongki', 'status' => 1],
            ['id' => 2, 'kode' => 'L02', 'nama' => 'Lingkungan Popanda', 'keterangan' => 'Lingkungan Popanda Kelurahan Bongki', 'status' => 1],
            ['id' => 3, 'kode' => 'L03', 'nama' => 'Lingkungan Benteng', 'keterangan' => 'Lingkungan Benteng Kelurahan Bongki', 'status' => 1],
            ['id' => 4, 'kode' => 'L04', 'nama' => 'Lingkungan Samaenre', 'keterangan' => 'Lingkungan Samaenre Kelurahan Bongki', 'status' => 1],
        ];
        foreach ($lingkungans as $l) {
            Lingkungan::create($l);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Jabatan
        |--------------------------------------------------------------------------
        */
        Jabatan::truncate();
        $jabatans = [
            ['id' => 2, 'parent_id' => NULL, 'nama' => 'Sekretaris Lurah', 'slug' => NULL, 'urutan' => 2, 'is_penandatangan' => 1, 'aktif' => 1, 'is_struktur' => 0],
            ['id' => 3, 'parent_id' => 11, 'nama' => 'Kasi Pemerintahan', 'slug' => 'kasi-pemerintahan', 'urutan' => 3, 'is_penandatangan' => 0, 'aktif' => 1, 'is_struktur' => 1],
            ['id' => 4, 'parent_id' => NULL, 'nama' => 'Kasi Pembangunan & Pemberdayaan Masyarakat', 'slug' => NULL, 'urutan' => 5, 'is_penandatangan' => 1, 'aktif' => 1, 'is_struktur' => 0],
            ['id' => 5, 'parent_id' => NULL, 'nama' => 'Kasi Pelayanan Umum', 'slug' => NULL, 'urutan' => 4, 'is_penandatangan' => 1, 'aktif' => 1, 'is_struktur' => 0],
            ['id' => 9, 'parent_id' => NULL, 'nama' => 'Plt. Lurah Bongki', 'slug' => NULL, 'urutan' => 1, 'is_penandatangan' => 1, 'aktif' => 1, 'is_struktur' => 0],
            ['id' => 10, 'parent_id' => NULL, 'nama' => 'Plt. Lurah', 'slug' => 'lurah', 'urutan' => 1, 'is_penandatangan' => 1, 'aktif' => 1, 'is_struktur' => 1],
            ['id' => 11, 'parent_id' => 10, 'nama' => 'Sekretaris Lurah', 'slug' => 'sekretaris-lurah', 'urutan' => 2, 'is_penandatangan' => 0, 'aktif' => 1, 'is_struktur' => 1],
            ['id' => 13, 'parent_id' => 11, 'nama' => 'Kasi Pelayanan Umum', 'slug' => 'kasi-pelayanan-umum', 'urutan' => 4, 'is_penandatangan' => 0, 'aktif' => 1, 'is_struktur' => 1],
            ['id' => 14, 'parent_id' => 11, 'nama' => 'Kasi PMD', 'slug' => 'kasi-ppm', 'urutan' => 5, 'is_penandatangan' => 0, 'aktif' => 1, 'is_struktur' => 1],
            ['id' => 15, 'parent_id' => 10, 'nama' => 'Kepala Lingkungan Paruntu', 'slug' => 'kepala-lingkungan-paruntu', 'urutan' => 10, 'is_penandatangan' => 0, 'aktif' => 1, 'is_struktur' => 1],
            ['id' => 16, 'parent_id' => 10, 'nama' => 'Kepala Lingkungan Benteng', 'slug' => 'kepala-lingkungan-benteng', 'urutan' => 11, 'is_penandatangan' => 0, 'aktif' => 1, 'is_struktur' => 1],
            ['id' => 17, 'parent_id' => 10, 'nama' => 'Kepala Lingkungan Popanda', 'slug' => 'kepala-lingkungan-popanda', 'urutan' => 12, 'is_penandatangan' => 0, 'aktif' => 1, 'is_struktur' => 1],
            ['id' => 18, 'parent_id' => 10, 'nama' => 'Kepala Lingkungan Samaenre', 'slug' => 'kepala-lingkungan-samaenre', 'urutan' => 13, 'is_penandatangan' => 0, 'aktif' => 1, 'is_struktur' => 1],
            ['id' => 19, 'parent_id' => 3, 'nama' => 'Staf Seksi Pemerintahan', 'slug' => 'staf-pemerintahan', 'urutan' => 20, 'is_penandatangan' => 0, 'aktif' => 1, 'is_struktur' => 1],
            ['id' => 20, 'parent_id' => 13, 'nama' => 'Staf Seksi Pelayanan Umum', 'slug' => 'staf-pelayanan', 'urutan' => 21, 'is_penandatangan' => 0, 'aktif' => 1, 'is_struktur' => 1],
            ['id' => 21, 'parent_id' => 14, 'nama' => 'Staf Seksi PMD', 'slug' => 'staf-ppm', 'urutan' => 22, 'is_penandatangan' => 0, 'aktif' => 1, 'is_struktur' => 1],
        ];
        foreach ($jabatans as $j) {
            Jabatan::create($j);
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Jenis Surat
        |--------------------------------------------------------------------------
        */
        JenisSurat::truncate();
        $jenisSurats = [
            [
                'id' => 1, 'kode' => 'KEMATIAN', 'nama' => 'Surat Keterangan Kematian', 'kode_surat' => NULL, 'kode_nomor' => NULL,
                'template_view' => 'surat.templates.kematian', 'deskripsi' => 'Persyaratan : KTP pelapor, KK almarhum, dan surat keterangan kematian dari rumah sakit atau pihak berwenang',
                'nomor_urut' => 0, 'icon' => 'bi-file-earmark-person', 'persyaratan' => "Fotokopi KTP Pelapor\nFotokopi KK Almarhum\nSurat Kematian RS/Dokter", 'aktif' => 1
            ],
            [
                'id' => 3, 'kode' => 'DOMISILI', 'nama' => 'Surat Keterangan Domisili', 'kode_surat' => NULL, 'kode_nomor' => NULL,
                'template_view' => 'surat.templates.keterangan-domisili', 'deskripsi' => 'Persyaratan : KTP, KK, dan surat pengantar RT/RW/Kepling',
                'nomor_urut' => 10, 'icon' => 'bi-house', 'persyaratan' => "Fotokopi KTP\nFotokopi KK", 'aktif' => 1
            ],
            [
                'id' => 5, 'kode' => 'SKTM', 'nama' => 'Surat Keterangan Tidak Mampu', 'kode_surat' => NULL, 'kode_nomor' => NULL,
                'template_view' => 'surat.templates.surat-keterangan-tidak-mampu', 'deskripsi' => 'Persyaratan : KTP, KK, dan surat pengantar RT/RW/Kepling atau dokumen pendukung sesuai keperluan',
                'nomor_urut' => 0, 'icon' => 'bi-file-earmark-text', 'persyaratan' => "Fotokopi KTP\nFotokopi KK", 'aktif' => 1
            ],
            [
                'id' => 6, 'kode' => 'SKBM', 'nama' => 'Surat Keterangan Belum Menikah', 'kode_surat' => NULL, 'kode_nomor' => NULL,
                'template_view' => 'surat.templates.surat-keterangan-belum-menikah', 'deskripsi' => 'Persyaratan : KTP, KK, dan surat pengantar RT/RW/Kepling',
                'nomor_urut' => 0, 'icon' => 'bi-heart', 'persyaratan' => "Fotokopi KTP\nFotokopi KK", 'aktif' => 1
            ],
            [
                'id' => 7, 'kode' => 'USAHA', 'nama' => 'Keterangan Usaha', 'kode_surat' => NULL, 'kode_nomor' => NULL,
                'template_view' => 'surat.templates.usaha', 'deskripsi' => 'Persyaratan : KTP, KK, dan surat pengantar RT/RW /Kepling',
                'nomor_urut' => 0, 'icon' => 'bi-shop', 'persyaratan' => "Fotokopi KTP\nFotokopi KK", 'aktif' => 1
            ],
            [
                'id' => 8, 'kode' => 'ORANG-SAMA', 'nama' => 'Surat Keterangan Orang Yang Sama', 'kode_surat' => NULL, 'kode_nomor' => '145',
                'template_view' => 'surat.templates.orang-sama', 'deskripsi' => 'Surat keterangan orang yang sama.',
                'nomor_urut' => 6, 'icon' => 'bi-person-check', 'persyaratan' => "Fotokopi KTP\nDokumen Perbedaan Nama", 'aktif' => 1
            ],
        ];
        foreach ($jenisSurats as $js) {
            JenisSurat::create($js);
        }

        /*
        |--------------------------------------------------------------------------
        | 5. Perangkat Kelurahan
        |--------------------------------------------------------------------------
        */
        Perangkat::truncate();
        $perangkats = [
            ['id' => 3, 'nama_lengkap' => 'ASHARI, S.Sos.,MM.', 'nip' => '19760822 200804 1 001', 'jabatan_id' => 9, 'jabatan_struktur_id' => 10, 'level' => 1, 'jenis_kelamin' => 'L', 'tanggal_lahir' => '1976-08-22', 'pendidikan' => 'Magister (S2)', 'telepon' => '082 299 362 534', 'foto' => 'perangkat/N4YRNSc25k1mGz5KRvFdnmtt9ytjv8h0nvFhN0nS.jpg', 'aktif' => 1, 'dapat_menandatangani' => 1],
            ['id' => 4, 'nama_lengkap' => 'SANRAWATI, S.E', 'nip' => '19780403 201101 2 005', 'jabatan_id' => 2, 'jabatan_struktur_id' => 11, 'level' => 3, 'jenis_kelamin' => 'P', 'pendidikan' => 'Sarjana (S1)', 'telepon' => '085 342 773 562', 'foto' => 'perangkat/813ki41roX3N3v1uyWMJPWBZyqYEmjEG4KU0r18c.png', 'aktif' => 1, 'dapat_menandatangani' => 0],
            ['id' => 5, 'nama_lengkap' => 'MUHAMMAD RUSMIN, S.IP', 'nip' => '19790506 200801 1 023', 'jabatan_id' => 5, 'jabatan_struktur_id' => 13, 'level' => 3, 'jenis_kelamin' => 'L', 'pendidikan' => 'Sarjana (S1)', 'telepon' => '085  126 765 730', 'foto' => 'perangkat/qyQE6kbRUTWnlsl6KeuPko9RFGGtOD52oPlJinZX.png', 'aktif' => 1, 'dapat_menandatangani' => 0],
            ['id' => 6, 'nama_lengkap' => 'FIRMAN, S.E', 'nip' => '19800313 200901 1 007', 'jabatan_id' => 3, 'jabatan_struktur_id' => 3, 'level' => 3, 'jenis_kelamin' => 'L', 'pendidikan' => 'Sarjana (S1)', 'telepon' => '089 988 555 25', 'foto' => 'perangkat/TAebTld5QW3nKhiNPB8tE6kAZK8QKOBZmWdfoFXL.jpg', 'aktif' => 1, 'dapat_menandatangani' => 0],
            ['id' => 7, 'nama_lengkap' => 'PARTINI H, S.E.,M.Ak', 'nip' => '19970127 202203 2 013', 'jabatan_id' => 4, 'jabatan_struktur_id' => 14, 'level' => 3, 'jenis_kelamin' => 'P', 'pendidikan' => 'Magister (S2)', 'telepon' => '085 342 558 363', 'foto' => 'perangkat/UsUgE2jH8WcoyKOvCifl3vm3YGmzo6f0JsIJKHui.jpg', 'aktif' => 1, 'dapat_menandatangani' => 0],
        ];
        foreach ($perangkats as $p) {
            Perangkat::create($p);
        }

        /*
        |--------------------------------------------------------------------------
        | 6. Website Settings
        |--------------------------------------------------------------------------
        */
        WebsiteSetting::truncate();
        WebsiteSetting::create([
            'id' => 1,
            'nama_website' => 'SIP Bongki',
            'nama_kelurahan' => 'Kelurahan Bongki',
            'logo' => 'website/FvuS04GzF2FpnYkOmR4DHJWhob0k6RWkWGPncoAZ.png',
            'alamat' => 'Jl. Bulu Patukku No.5, Kelurahan Bongki',
            'telepon' => '(0482) xxxx',
            'email' => 'kelurahanbongki.90@gmail.com',
            'gambar_hero' => 'website/ia9Q2Pr16IVv5GM5By1RwKSuMWjbOieBxq0FUzab.png',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 7. Kartu Keluarga (Real Data Dump)
        |--------------------------------------------------------------------------
        */
        KartuKeluarga::truncate();
        $kartuKeluargas = [
            ['id' => 5, 'no_kk' => '7307050112080001', 'kepala_keluarga_id' => 2, 'alamat' => 'Jl. Gunung Latimojong', 'rt' => NULL, 'rw' => '001', 'lingkungan_id' => 1, 'aktif' => 1],
            ['id' => 6, 'no_kk' => '7307050505250003', 'kepala_keluarga_id' => 7, 'alamat' => 'Btn. Tangka Mas Blok E No.39', 'rt' => '001', 'rw' => '001', 'lingkungan_id' => 1, 'aktif' => 1],
            ['id' => 7, 'no_kk' => '7307052901053400', 'kepala_keluarga_id' => 11, 'alamat' => 'Jl. Bulu Bicara', 'rt' => '004', 'rw' => '002', 'lingkungan_id' => 1, 'aktif' => 1],
        ];
        foreach ($kartuKeluargas as $kk) {
            KartuKeluarga::create($kk);
        }

        /*
        |--------------------------------------------------------------------------
        | 8. Penduduk (Real Data Dump)
        |--------------------------------------------------------------------------
        */
        Penduduk::truncate();
        $penduduks = [
            ['id' => 2, 'nik' => '7307050112750007', 'nama_lengkap' => 'Pahri', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Matumpu', 'tanggal_lahir' => '1975-12-01', 'agama' => 'Islam', 'status_perkawinan' => 'Kawin', 'pendidikan' => 'SMP/Sederajat', 'pekerjaan' => 'Wiraswasta', 'alamat' => 'Jl. Gunung Latimojong', 'rt' => '004', 'rw' => '001', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 1, 'kartu_keluarga_id' => 5, 'hubungan_keluarga' => 'Kepala Keluarga', 'telepon' => '085242212456', 'aktif' => 1],
            ['id' => 3, 'nik' => '7307057112830006', 'nama_lengkap' => 'Saleha', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Bone', 'tanggal_lahir' => '1983-02-09', 'agama' => 'Islam', 'status_perkawinan' => 'Kawin', 'pendidikan' => 'SMA/Sederajat', 'pekerjaan' => 'Mengurus Rumah Tangga', 'alamat' => 'Jl. Gunung Latimojong', 'rt' => '004', 'rw' => '001', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 1, 'kartu_keluarga_id' => 5, 'hubungan_keluarga' => 'Istri', 'telepon' => NULL, 'aktif' => 1],
            ['id' => 4, 'nik' => '7307055101050001', 'nama_lengkap' => 'Sahra', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Sinjai', 'tanggal_lahir' => '2005-01-11', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pendidikan' => 'SD/Sederajat', 'pekerjaan' => 'Pelajar/Mahasiswa', 'alamat' => 'Jl. Gunung Latimojong', 'rt' => '004', 'rw' => '001', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 1, 'kartu_keluarga_id' => 5, 'hubungan_keluarga' => 'Anak', 'telepon' => NULL, 'aktif' => 1],
            ['id' => 5, 'nik' => '7307055909180001', 'nama_lengkap' => 'Rezki Mutahharah', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Sinjai', 'tanggal_lahir' => '2022-06-07', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pendidikan' => 'Tidak/Belum Sekolah', 'pekerjaan' => 'Belum/Tidak Bekerja', 'alamat' => 'Jl. Gunung Latimojong', 'rt' => '004', 'rw' => '001', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 1, 'kartu_keluarga_id' => 5, 'hubungan_keluarga' => 'Anak', 'telepon' => NULL, 'aktif' => 1],
            ['id' => 6, 'nik' => '7307054708200001', 'nama_lengkap' => 'Fara Syakira Alifia', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Sinjai', 'tanggal_lahir' => '2020-06-09', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pendidikan' => 'Tidak/Belum Sekolah', 'pekerjaan' => 'Belum/Tidak Bekerja', 'alamat' => 'Jl. Gunung Latimojong', 'rt' => '004', 'rw' => '001', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 1, 'kartu_keluarga_id' => 5, 'hubungan_keluarga' => 'Anak', 'telepon' => 's00790f', 'aktif' => 1],
            ['id' => 7, 'nik' => '7401185911740001', 'nama_lengkap' => 'Rosdiana', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Sinjai', 'tanggal_lahir' => '1974-11-19', 'agama' => 'Islam', 'status_perkawinan' => 'Cerai Hidup', 'pendidikan' => 'SMA/Sederajat', 'pekerjaan' => 'Belum/Tidak Bekerja', 'alamat' => 'Btn. Tangka Mas Blok E No. 39', 'rt' => '001', 'rw' => '001', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 1, 'kartu_keluarga_id' => 6, 'hubungan_keluarga' => 'Kepala Keluarga', 'telepon' => NULL, 'aktif' => 1],
            ['id' => 8, 'nik' => '7401181701120001', 'nama_lengkap' => 'Hasram Saputra', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Lalonggolosua', 'tanggal_lahir' => '2012-01-17', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pendidikan' => 'SMA/Sederajat', 'pekerjaan' => 'Belum/Tidak Bekerja', 'alamat' => 'Btn. Tangka Mas Blok E No.39', 'rt' => '001', 'rw' => '001', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 1, 'kartu_keluarga_id' => 6, 'hubungan_keluarga' => 'Anak', 'telepon' => NULL, 'aktif' => 1],
            ['id' => 9, 'nik' => '7401184702030002', 'nama_lengkap' => 'Ita Yusnita', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Oko-Oko', 'tanggal_lahir' => '2003-02-07', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pendidikan' => 'SD/Sederajat', 'pekerjaan' => 'Belum/Tidak Bekerja', 'alamat' => 'Btn. Tangka Mas Blok E No.39', 'rt' => '001', 'rw' => '001', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 1, 'kartu_keluarga_id' => 6, 'hubungan_keluarga' => 'Anak', 'telepon' => NULL, 'aktif' => 1],
            ['id' => 10, 'nik' => '7401184103020002', 'nama_lengkap' => 'Nirmayanti', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Putemata', 'tanggal_lahir' => '2002-03-01', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pendidikan' => 'Tidak/Belum Sekolah', 'pekerjaan' => 'Belum/Tidak Bekerja', 'alamat' => 'Btn. Tangka Mas Blok E No.39', 'rt' => '001', 'rw' => '001', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 1, 'kartu_keluarga_id' => 6, 'hubungan_keluarga' => 'Anak', 'telepon' => NULL, 'aktif' => 1],
            ['id' => 11, 'nik' => '7307053112700053', 'nama_lengkap' => 'Shabaruddin', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Sinjai', 'tanggal_lahir' => '1970-12-31', 'agama' => 'Islam', 'status_perkawinan' => 'Kawin', 'pendidikan' => 'SMA/Sederajat', 'pekerjaan' => 'Perdagangan', 'alamat' => 'Jl. Bulu Bicara', 'rt' => '004', 'rw' => '002', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 1, 'kartu_keluarga_id' => 7, 'hubungan_keluarga' => 'Kepala Keluarga', 'telepon' => NULL, 'aktif' => 1],
            ['id' => 12, 'nik' => '7307050109030001', 'nama_lengkap' => 'Muhammad Fahri', 'jenis_kelamin' => 'L', 'tempat_lahir' => 'Sinjai', 'tanggal_lahir' => '2003-09-01', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pendidikan' => 'SMA/Sederajat', 'pekerjaan' => 'Belum/Tidak Bekerja', 'alamat' => 'Bumi Benteng Mas (Jl. Petta Ponggawae)', 'rt' => '002', 'rw' => '002', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 3, 'kartu_keluarga_id' => NULL, 'hubungan_keluarga' => 'Anak', 'telepon' => '089 532 149 3193', 'aktif' => 1],
            ['id' => 13, 'nik' => '7307055211810001', 'nama_lengkap' => 'Nurlita', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Sinjai', 'tanggal_lahir' => '1981-11-12', 'agama' => 'Islam', 'status_perkawinan' => 'Cerai Hidup', 'pendidikan' => 'SMA/Sederajat', 'pekerjaan' => 'Mengurus Rumah Tangga', 'alamat' => 'Jl. Petta Ponggawae', 'rt' => '001', 'rw' => '002', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 4, 'kartu_keluarga_id' => NULL, 'hubungan_keluarga' => NULL, 'telepon' => '085 754 378 256', 'aktif' => 1],
            ['id' => 14, 'nik' => '7307054906080002', 'nama_lengkap' => 'Musyarrifa. F', 'jenis_kelamin' => 'P', 'tempat_lahir' => 'Sinjai', 'tanggal_lahir' => '2013-06-02', 'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pendidikan' => 'SMA/Sederajat', 'pekerjaan' => 'Pelajar/Mahasiswa', 'alamat' => 'JL. Bulu Saraung', 'rt' => '001', 'rw' => '002', 'status_validasi_alamat' => 'Valid', 'lingkungan_id' => 1, 'kartu_keluarga_id' => NULL, 'hubungan_keluarga' => NULL, 'telepon' => NULL, 'aktif' => 1],
        ];
        foreach ($penduduks as $p) {
            Penduduk::create($p);
        }

        /*
        |--------------------------------------------------------------------------
        | 9. Agendas, Beritas, Galeris (Real Data Dump)
        |--------------------------------------------------------------------------
        */
        Agenda::truncate();
        $agendas = [
            ['id' => 4, 'judul' => 'Kegiatan Sosialisasi terkait Prilaku Hidup Bersih dan Sehat', 'deskripsi' => 'Kegiatan sosialisasi mengenai pentingnya Perilaku Hidup Bersih dan Sehat (PHBS) sebagai upaya menciptakan lingkungan yang sehat, bersih, dan nyaman bagi masyarakat Kelurahan Bongki', 'tanggal' => '2026-07-29', 'waktu' => NULL, 'lokasi' => 'Aula Kantor Kelurahan Bongki', 'status' => 'aktif'],
            ['id' => 5, 'judul' => 'Posyandu', 'deskripsi' => NULL, 'tanggal' => '2026-08-06', 'waktu' => '08:00', 'lokasi' => 'Posyandu Kartini', 'status' => 'aktif'],
            ['id' => 6, 'judul' => 'Posyandu', 'deskripsi' => NULL, 'tanggal' => '2026-08-07', 'waktu' => '08:00', 'lokasi' => 'Posyandu Asoka', 'status' => 'aktif'],
        ];
        foreach ($agendas as $a) {
            Agenda::create($a);
        }

        Berita::truncate();
        Berita::create([
            'id' => 1,
            'judul' => 'Pelayanan Administrasi Digital Kelurahan Bongki',
            'slug' => 'pelayanan-administrasi-digital-kelurahan-bongki',
            'isi' => 'Sistem Informasi Pelayanan Publik Kelurahan Bongki (SIPBONGKI) resmi hadir untuk mempermudah permohonan surat kependudukan masyarakat.',
            'status' => 'publish',
            'tanggal_publish' => now(),
        ]);

        Galeri::truncate();
        $galeris = [
            ['id' => 2, 'judul' => 'Kegiatan Kemasyarakatan 1', 'deskripsi' => 'Dokumentasi kegiatan di Kelurahan Bongki', 'gambar' => 'galeri/CfoGMXilfwRREQORXxKbf2vd01vtsn3IlXdkvWgV.jpg', 'status' => 'aktif'],
            ['id' => 3, 'judul' => 'Kegiatan Kemasyarakatan 2', 'deskripsi' => 'Dokumentasi kegiatan di Kelurahan Bongki', 'gambar' => 'galeri/8kchDpCRzAOa40MJSg56YEX2KFoqTfw3WU4dV6t6.jpg', 'status' => 'aktif'],
        ];
        foreach ($galeris as $g) {
            Galeri::create($g);
        }

        /*
        |--------------------------------------------------------------------------
        | 10. Permohonan Surat & Histories (Real Data Dump)
        |--------------------------------------------------------------------------
        */
        PermohonanSurat::truncate();
        $permohonanSurats = [
            [
                'id' => 68, 'nomor_permohonan' => 'PMH-20260730051855', 'nomor_surat' => '145/001/Bk-Sut', 'tanggal_permohonan' => '2026-07-30',
                'penduduk_id' => 6, 'pelapor_id' => NULL, 'jenis_surat_id' => 3, 'penandatangan_id' => 5,
                'keperluan' => 'pengurusan kredit  kendaraan bermotor', 'data_surat' => [], 'status' => 'Selesai',
                'operator_id' => NULL, 'tanggal_selesai' => '2026-07-30', 'catatan' => NULL, 'created_at' => '2026-07-29 21:18:55', 'updated_at' => '2026-07-29 21:19:10'
            ],
            [
                'id' => 69, 'nomor_permohonan' => 'PMH-20260730052544', 'nomor_surat' => '145/002/Bk-Sut', 'tanggal_permohonan' => '2026-07-30',
                'penduduk_id' => 8, 'pelapor_id' => NULL, 'jenis_surat_id' => 6, 'penandatangan_id' => 6,
                'keperluan' => 'untuk pengurusan kelengkapan berkas pendukung kredit perumahan', 'data_surat' => [], 'status' => 'Selesai',
                'operator_id' => NULL, 'tanggal_selesai' => '2026-07-30', 'catatan' => NULL, 'created_at' => '2026-07-29 21:25:44', 'updated_at' => '2026-07-29 21:25:57'
            ],
            [
                'id' => 70, 'nomor_permohonan' => 'PMH-20260730052732', 'nomor_surat' => '581/001/Bk-Sut', 'tanggal_permohonan' => '2026-07-30',
                'penduduk_id' => 13, 'pelapor_id' => NULL, 'jenis_surat_id' => 7, 'penandatangan_id' => 7,
                'keperluan' => 'pengajuan kredit tambahan usaha', 'data_surat' => ['nama_usaha' => 'Lita elektronik', 'jenis_usaha' => 'Elektronik', 'alamat_usaha' => 'Jl. Petta Ponggawae', 'lama_usaha' => '2 Tahun'], 'status' => 'Selesai',
                'operator_id' => NULL, 'tanggal_selesai' => '2026-07-30', 'catatan' => NULL, 'created_at' => '2026-07-29 21:27:32', 'updated_at' => '2026-07-29 21:27:42'
            ],
            [
                'id' => 71, 'nomor_permohonan' => 'PMH-20260730052815', 'nomor_surat' => '451.6/001/Bk-Sut', 'tanggal_permohonan' => '2026-07-30',
                'penduduk_id' => 5, 'pelapor_id' => NULL, 'jenis_surat_id' => 5, 'penandatangan_id' => 3,
                'keperluan' => 'pengurusan beasiswa pendidikan', 'data_surat' => [], 'status' => 'Selesai',
                'operator_id' => NULL, 'tanggal_selesai' => '2026-07-30', 'catatan' => NULL, 'created_at' => '2026-07-29 21:28:15', 'updated_at' => '2026-07-29 21:28:25'
            ],
            [
                'id' => 72, 'nomor_permohonan' => 'PMH-20260730052913', 'nomor_surat' => '474.3/001/Bk-Sut', 'tanggal_permohonan' => '2026-07-30',
                'penduduk_id' => 13, 'pelapor_id' => 2, 'jenis_surat_id' => 1, 'penandatangan_id' => 5,
                'keperluan' => 'pengurusan akta kematian', 'data_surat' => ['hari_meninggal' => 'Selasa', 'tanggal_meninggal' => '2026-07-14', 'jam_meninggal' => '10:10', 'tempat_meninggal' => 'Rumah Sakit', 'penyebab_kematian' => 'Sakit', 'hubungan_pelapor' => 'Keluarga'], 'status' => 'Selesai',
                'operator_id' => NULL, 'tanggal_selesai' => '2026-07-30', 'catatan' => NULL, 'created_at' => '2026-07-29 21:29:13', 'updated_at' => '2026-07-29 21:29:23'
            ],
            [
                'id' => 74, 'nomor_permohonan' => 'PMH-20260730060528', 'nomor_surat' => '145/003/Bk-Sut', 'tanggal_permohonan' => '2026-07-30',
                'penduduk_id' => 10, 'pelapor_id' => NULL, 'jenis_surat_id' => 8, 'penandatangan_id' => 3,
                'keperluan' => 'pengurusan di pertanahan', 'data_surat' => ['nama_lain' => 'Nirmayati', 'jenis_dokumen' => 'Sertifikat Hak Milik', 'nomor_dokumen' => 'SHM No. 123', 'keterangan_perbedaan' => 'Perbedaan penulisan nama'], 'status' => 'Selesai',
                'operator_id' => NULL, 'tanggal_selesai' => '2026-07-30', 'catatan' => NULL, 'created_at' => '2026-07-29 22:05:28', 'updated_at' => '2026-07-29 22:05:39'
            ],
            [
                'id' => 75, 'nomor_permohonan' => 'PMH-20260731013005', 'nomor_surat' => '145/004/Bk-Sut', 'tanggal_permohonan' => '2026-07-31',
                'penduduk_id' => 2, 'pelapor_id' => NULL, 'jenis_surat_id' => 3, 'penandatangan_id' => 7,
                'keperluan' => 'pengurusan administrasi', 'data_surat' => [], 'status' => 'Selesai',
                'operator_id' => NULL, 'tanggal_selesai' => '2026-07-31', 'catatan' => NULL, 'created_at' => '2026-07-30 17:30:05', 'updated_at' => '2026-07-30 17:30:43'
            ],
            [
                'id' => 76, 'nomor_permohonan' => 'PMH-20260731031330', 'nomor_surat' => NULL, 'tanggal_permohonan' => '2026-07-31',
                'penduduk_id' => 9, 'pelapor_id' => NULL, 'jenis_surat_id' => 3, 'penandatangan_id' => 4,
                'keperluan' => 'persyaratan berkas', 'data_surat' => [], 'status' => 'Menunggu',
                'operator_id' => NULL, 'tanggal_selesai' => NULL, 'catatan' => NULL, 'created_at' => '2026-07-30 19:13:30', 'updated_at' => '2026-07-30 19:13:30'
            ],
        ];
        foreach ($permohonanSurats as $ps) {
            PermohonanSurat::create($ps);
        }

        PermohonanSuratHistory::truncate();
        $histories = [
            ['permohonan_surat_id' => 68, 'status_lama' => 'Menunggu', 'status_baru' => 'Selesai', 'catatan' => 'Surat selesai diterbitkan', 'user_id' => 1, 'created_at' => '2026-07-29 21:19:10'],
            ['permohonan_surat_id' => 69, 'status_lama' => 'Menunggu', 'status_baru' => 'Selesai', 'catatan' => 'Surat selesai diterbitkan', 'user_id' => 1, 'created_at' => '2026-07-29 21:25:57'],
            ['permohonan_surat_id' => 70, 'status_lama' => 'Menunggu', 'status_baru' => 'Selesai', 'catatan' => 'Surat selesai diterbitkan', 'user_id' => 1, 'created_at' => '2026-07-29 21:27:42'],
            ['permohonan_surat_id' => 71, 'status_lama' => 'Menunggu', 'status_baru' => 'Selesai', 'catatan' => 'Surat selesai diterbitkan', 'user_id' => 1, 'created_at' => '2026-07-29 21:28:25'],
            ['permohonan_surat_id' => 72, 'status_lama' => 'Menunggu', 'status_baru' => 'Selesai', 'catatan' => 'Surat selesai diterbitkan', 'user_id' => 1, 'created_at' => '2026-07-29 21:29:23'],
            ['permohonan_surat_id' => 74, 'status_lama' => 'Menunggu', 'status_baru' => 'Selesai', 'catatan' => 'Surat selesai diterbitkan', 'user_id' => 1, 'created_at' => '2026-07-29 22:05:39'],
            ['permohonan_surat_id' => 75, 'status_lama' => 'Menunggu', 'status_baru' => 'Selesai', 'catatan' => 'Surat selesai diterbitkan', 'user_id' => 1, 'created_at' => '2026-07-30 17:30:43'],
        ];
        foreach ($histories as $h) {
            PermohonanSuratHistory::create($h);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
