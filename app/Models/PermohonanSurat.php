<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $fillable = [

        'nomor_permohonan',

        'nomor_surat',

        'penduduk_id',

        'pelapor_id',

        'jenis_surat_id',

        'tanggal_permohonan',

        'keperluan',

        'status',

        'operator_id',

        'tanggal_selesai',

        'catatan',

        'penandatangan_id',

        'data_surat',

        /*
        |--------------------------------------------------------------------------
        | Surat Keterangan Kematian
        |--------------------------------------------------------------------------
        */

        'hari_meninggal',

        'tanggal_meninggal',

        'jam_meninggal',

        'tempat_meninggal',

        'penyebab_kematian',

        'hubungan_pelapor',

    ];

    protected $casts = [

        'tanggal_permohonan' => 'date',

        'tanggal_selesai' => 'date',

        'tanggal_meninggal' => 'date',

        'created_at' => 'datetime',

        'updated_at' => 'datetime',

        'data_surat' => 'array',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function penduduk()
    {
        return $this->belongsTo(
            Penduduk::class,
            'penduduk_id'
        );
    }

    public function pelapor()
    {
        return $this->belongsTo(
            Penduduk::class,
            'pelapor_id'
        );
    }

    public function jenisSurat()
    {
        return $this->belongsTo(
            JenisSurat::class,
            'jenis_surat_id'
        );
    }

    public function operator()
    {
        return $this->belongsTo(
            User::class,
            'operator_id'
        );
    }

    public function penandatangan()
    {
        return $this->belongsTo(
            Perangkat::class,
            'penandatangan_id'
        );
    }

    public function histories()
    {
        return $this->hasMany(
            PermohonanSuratHistory::class,
            'permohonan_surat_id'
        )->latest();
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {

            'Menunggu' => 'warning',

            'Diproses' => 'info',

            'Selesai' => 'success',

            'Ditolak' => 'danger',

            default => 'secondary',

        };
    }

    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }
}