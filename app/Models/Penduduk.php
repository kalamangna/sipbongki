<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penduduk extends Model
{
    use HasFactory;


    protected $fillable = [

        'nik',
        'nama_lengkap',
        'jenis_kelamin',

        'tempat_lahir',
        'tanggal_lahir',

        'agama',
        'status_perkawinan',

        'pendidikan',
        'pekerjaan',

        'alamat',

        'rt',
        'rw',

        'status_validasi_alamat',

        'lingkungan_id',
        'kartu_keluarga_id',

        'hubungan_keluarga',

        'telepon',
        'email',

        'foto',

        'aktif',

        'is_public',

    ];



    protected $casts = [
        'tanggal_lahir' => 'date',
        'aktif' => 'boolean',
        'is_public' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home_demografi_stats');
            \Illuminate\Support\Facades\Cache::forget('home_public_lingkungans');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home_demografi_stats');
            \Illuminate\Support\Facades\Cache::forget('home_public_lingkungans');
        });
    }



    /*
    |--------------------------------------------------------------------------
    | Relasi Lingkungan
    |--------------------------------------------------------------------------
    */

    public static function pekerjaanList(): array
    {
        return [
            'Belum/Tidak Bekerja',
            'Mengurus Rumah Tangga',
            'Pelajar/Mahasiswa',
            'Pensiunan',
            'Pegawai Negeri Sipil (PNS)',
            'PPPK',
            'ASN',
            'Tentara Nasional Indonesia (TNI)',
            'Kepolisian RI (POLRI)',
            'Perdagangan',
            'Petani/Pekebun',
            'Peternak',
            'Nelayan/Perikanan',
            'Karyawan Swasta',
            'Wiraswasta',
            'Buruh Harian Lepas',
            'Guru',
            'Dosen',
            'Perawat',
            'Bidan',
            'Dokter',
            'Perangkat Desa/Kelurahan',
            'Lainnya',
        ];
    }

    public static function agamaList(): array
    {
        return [
            'Islam',
            'Kristen',
            'Katolik',
            'Hindu',
            'Buddha',
            'Konghucu',
        ];
    }

    public function lingkungan()
    {
        return $this->belongsTo(
            Lingkungan::class
        );
    }



    /*
    |--------------------------------------------------------------------------
    | Relasi Kartu Keluarga
    |--------------------------------------------------------------------------
    */

    public function kartuKeluarga()
    {
        return $this->belongsTo(
            KartuKeluarga::class
        );
    }
/*
|--------------------------------------------------------------------------
| Relasi Permohonan Surat
|--------------------------------------------------------------------------
*/

public function permohonanSurats()
{
    return $this->hasMany(
        PermohonanSurat::class
    );
}

}
