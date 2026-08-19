<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Penduduk;
use App\Models\JenisSurat;
use App\Models\User;
use App\Models\Perangkat;
use App\Models\PermohonanSuratHistory;

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

        'tanggal_permohonan' => 'datetime',

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

    public function getPemohonAttribute()
    {
        if ($this->penduduk_id) {
            return $this->penduduk;
        }

        $data = $this->data_surat ?? [];

        return (object) [
            'nama_lengkap'  => $data['manual_nama_lengkap'] ?? $data['nama_lengkap'] ?? $data['nama_pemohon'] ?? null,
            'nik'           => $data['manual_nik'] ?? $data['nik'] ?? null,
            'tempat_lahir'  => $data['manual_tempat_lahir'] ?? $data['tempat_lahir'] ?? null,
            'tanggal_lahir' => $data['manual_tanggal_lahir'] ?? $data['tanggal_lahir'] ?? null,
            'jenis_kelamin' => $data['manual_jenis_kelamin'] ?? $data['jenis_kelamin'] ?? null,
            'agama'         => $data['manual_agama'] ?? $data['agama'] ?? null,
            'pekerjaan'     => $data['manual_pekerjaan'] ?? $data['pekerjaan'] ?? null,
            'telepon'       => $data['manual_telepon'] ?? $data['telepon'] ?? null,
            'alamat'        => $data['manual_alamat'] ?? $data['alamat'] ?? null,
            'rt'            => $data['manual_rt'] ?? $data['rt'] ?? null,
            'rw'            => $data['manual_rw'] ?? $data['rw'] ?? null,
            'lingkungan'    => null, // mock relationship
            'no_kk'         => $data['manual_no_kk'] ?? $data['no_kk'] ?? null,
        ];
    }

    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            'Menunggu' => 'amber',
            'Diproses' => 'sky',
            'Selesai' => 'emerald',
            'Ditolak' => 'rose',
            default => 'slate',
        };
    }

    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }
}