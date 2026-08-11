<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanSuratHistory extends Model
{
    protected $fillable = [

        'permohonan_surat_id',

        'status_lama',

        'status_baru',

        'catatan',

        'user_id',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function permohonanSurat()
    {
        return $this->belongsTo(
            PermohonanSurat::class
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    public function getBadgeClassAttribute()
    {
        return match ($this->status_baru) {

            'Menunggu' => 'warning',

            'Diproses' => 'info',

            'Selesai'  => 'success',

            'Ditolak'  => 'danger',

            default => 'secondary',

        };
    }
}