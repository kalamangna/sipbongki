<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisSurat extends Model
{
    use HasFactory;

    protected $fillable = [

    'kode',
    'nama',
    'deskripsi',
    'nomor_urut',
    'kode_nomor',
    'template_view',
    'icon',
    'persyaratan',
    'aktif',

];

    protected $casts = [

        'aktif' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function permohonanSurats(): HasMany
    {
        return $this->hasMany(
            PermohonanSurat::class,
            'jenis_surat_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    */

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    public function getNamaLengkapAttribute(): string
    {
        return "{$this->kode} - {$this->nama}";
    }

    /**
 * Template Blade surat
 */
public function getTemplateAttribute(): string
{
    if (!$this->template_view) {
        throw new \RuntimeException(
            "Template surat untuk {$this->nama} belum ditentukan."
        );
    }

    return $this->template_view;
}

    /**
     * Mutator mutator/setter untuk atribut template agar tidak dicoba disimpan ke DB
     */
    public function setTemplateAttribute($value): void
    {
        $this->attributes['template_view'] = $value;
    }
}