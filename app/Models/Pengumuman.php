<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumen';

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
}