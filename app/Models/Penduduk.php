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

    ];



    protected $casts = [

        'tanggal_lahir' => 'date',

        'aktif' => 'boolean',

    ];



    /*
    |--------------------------------------------------------------------------
    | Relasi Lingkungan
    |--------------------------------------------------------------------------
    */

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
