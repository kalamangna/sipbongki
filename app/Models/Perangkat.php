<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perangkat extends Model
{
    use HasFactory;

    protected $fillable = [

        'nama_lengkap',
        'nip',

       
        'jabatan_id',
        
        'jabatan_struktur_id',

        'parent_id',

        'level',

        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',

        'pendidikan',

        'telepon',
        'email',
        'alamat',

        'tanggal_mulai_jabatan',
        'tanggal_selesai_jabatan',

        'foto',

        'aktif',

        'dapat_menandatangani',

        'keterangan',

    ];

   protected $casts = [

    'tanggal_lahir' => 'date',
    'tanggal_mulai_jabatan' => 'date',
    'tanggal_selesai_jabatan' => 'date',

    'aktif' => 'boolean',
    'dapat_menandatangani' => 'boolean',

    'level' => 'integer',
    'parent_id' => 'integer',
    'jabatan_struktur_id' => 'integer',

];

    protected static function booted(): void
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home_public_struktur');
            \Illuminate\Support\Facades\Cache::forget('home_demografi_stats');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home_public_struktur');
            \Illuminate\Support\Facades\Cache::forget('home_demografi_stats');
        });
    }
    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(
            Jabatan::class,
            'jabatan_id'
        );
    }
public function jabatanStruktur(): BelongsTo
{
    return $this->belongsTo(
        Jabatan::class,
        'jabatan_struktur_id'
    );
}
    /*
    |--------------------------------------------------------------------------
    | Hierarki Perangkat
    |--------------------------------------------------------------------------
    */

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            Perangkat::class,
            'parent_id'
        );
    }

    public function children(): HasMany
    {
        return $this->hasMany(
            Perangkat::class,
            'parent_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Persuratan
    |--------------------------------------------------------------------------
    */

    public function permohonanSurats(): HasMany
    {
        return $this->hasMany(
            PermohonanSurat::class,
            'penandatangan_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    public function getNamaDanJabatanAttribute(): string
    {
        return "{$this->nama_lengkap} (" .
            ($this->jabatan->nama ?? '-') .
            ")";
    }
}