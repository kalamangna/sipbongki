<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Galeri extends Model
{

    use HasFactory;



    protected $table = 'galeris';



    protected $fillable = [

        'judul',
        'deskripsi',
        'gambar',
        'status'

    ];

    protected static function booted(): void
    {
        static::saved(fn () => \Illuminate\Support\Facades\Cache::forget('home_public_galeris'));
        static::deleted(fn () => \Illuminate\Support\Facades\Cache::forget('home_public_galeris'));
    }



}