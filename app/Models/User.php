<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Penduduk;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'penduduk_id',
    ];

    /**
     * The attributes that should be hidden.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     */
    protected function casts(): array
    {
        return [];
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    /**
     * User terhubung dengan data penduduk.
     */
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }


    /**
     * Permohonan surat yang diproses operator.
     */
    public function permohonanSurats()
    {
        return $this->hasMany(
            PermohonanSurat::class,
            'operator_id'
        );
    }
}