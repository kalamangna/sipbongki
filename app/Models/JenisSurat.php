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

    public function isDomisili(): bool
    {
        return in_array(strtoupper($this->kode), ['DOMISILI', 'SK-002'])
            || str_contains(strtolower($this->nama), 'domisili');
    }

    public function isUsaha(): bool
    {
        return in_array(strtoupper($this->kode), ['USAHA'])
            || str_contains(strtolower($this->nama), 'usaha');
    }

    public function isKematian(): bool
    {
        return in_array(strtoupper($this->kode), ['KEMATIAN'])
            || str_contains(strtolower($this->nama), 'kematian');
    }

    public function isOrangSama(): bool
    {
        return in_array(strtoupper($this->kode), ['ORANG-SAMA'])
            || str_contains(strtolower($this->nama), 'orang sama')
            || str_contains(strtolower($this->nama), 'orang yang sama');
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
}