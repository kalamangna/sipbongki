<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans';

    protected $fillable = [
    'nama',
    'slug',
    'parent_id',
    'urutan',
    'is_penandatangan',
    'is_struktur',
    'aktif',
];

    protected $casts = [
    'parent_id' => 'integer',
    'is_penandatangan' => 'boolean',
    'is_struktur' => 'boolean',
    'aktif' => 'boolean',
];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function perangkat(): HasMany
    {
        return $this->hasMany(Perangkat::class);
    }

    /*
|--------------------------------------------------------------------------
| Perangkat Aktif
|--------------------------------------------------------------------------
*/

public function perangkatAktif(): HasMany
{
    return $this->hasMany(Perangkat::class)
                ->where('aktif', true)
                ->orderBy('nama_lengkap');
}

public function perangkatStruktur(): HasMany
{
    return $this->hasMany(
        Perangkat::class,
        'jabatan_struktur_id'
    )
    ->where('aktif', true)
    ->orderBy('nama_lengkap');
}
    /*
    |--------------------------------------------------------------------------
    | Hierarki Jabatan
    |--------------------------------------------------------------------------
    */

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, 'parent_id');
    }

    public function children(): HasMany
{
    return $this->hasMany(Jabatan::class, 'parent_id')
                ->where('is_struktur', true)
                ->with('perangkatStruktur')
                ->orderBy('urutan');
}

/**
|--------------------------------------------------------------------------
| Hierarki Struktur Recursive
|--------------------------------------------------------------------------
*/

public function childrenRecursive(): HasMany
{
    return $this->hasMany(Jabatan::class, 'parent_id')
        ->where('is_struktur', true)
        ->with([
            'perangkatStruktur',
            'childrenRecursive'
        ])
        ->orderBy('urutan');
}

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    public function getParentNamaAttribute(): ?string
    {
        return $this->parent?->nama;
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

    public function scopePenandatangan($query)
    {
        return $query->where('is_penandatangan', true);
    }
}