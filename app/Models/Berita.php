<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;


    protected $table = 'beritas';


    protected $fillable = [

        'judul',
        'slug',
        'isi',
        'gambar',
        'status',
        'tanggal_publish',

    ];


    protected $casts = [

        'tanggal_publish' => 'date',

    ];

    /**
     * Menggunakan slug sebagai route key binding
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}