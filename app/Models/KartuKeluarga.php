<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KartuKeluarga extends Model
{
    use HasFactory;


    protected $fillable = [

        'no_kk',

        'kepala_keluarga_id',

        'alamat',

        'rt',

        'rw',

        'lingkungan_id',

        'aktif',

    ];



    protected $casts = [

        'aktif' => 'boolean',

    ];



    /*
    |--------------------------------------------------------------------------
    | Kepala Keluarga
    |--------------------------------------------------------------------------
    |
    | Satu KK memiliki satu kepala keluarga
    |
    */

    public function kepalaKeluarga()
    {
        return $this->belongsTo(
            Penduduk::class,
            'kepala_keluarga_id'
        );
    }



    /*
|--------------------------------------------------------------------------
| Anggota Keluarga
|--------------------------------------------------------------------------
|
| Semua anggota yang berada dalam KK ini.
|
*/

public function anggota()
{
    return $this->hasMany(
        Penduduk::class,
        'kartu_keluarga_id'
    );
}
public function penduduks()
{
    return $this->anggota();
}


    /*
    |--------------------------------------------------------------------------
    | Lingkungan
    |--------------------------------------------------------------------------
    */

    public function lingkungan()
    {
        return $this->belongsTo(
            Lingkungan::class
        );
    }

}