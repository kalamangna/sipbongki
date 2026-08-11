<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Lingkungan extends Model
{

    use HasFactory;



    protected $table = 'lingkungans';



    protected $fillable = [

        'kode',
        'nama',
        'ketua_lingkungan',
        'telepon',
        'keterangan',
        'status',

    ];



    protected $casts = [

        'status' => 'boolean',

    ];





    /*
    |--------------------------------------------------------------------------
    | Relasi Penduduk
    |--------------------------------------------------------------------------
    */


    public function penduduk()
    {

        return $this->hasMany(

            Penduduk::class,

            'lingkungan_id'

        );

    }
/*
|--------------------------------------------------------------------------
| Relasi Kartu Keluarga
|--------------------------------------------------------------------------
*/

public function kartuKeluargas()
{
    return $this->hasMany(
        KartuKeluarga::class,
        'lingkungan_id'
    );
}

}