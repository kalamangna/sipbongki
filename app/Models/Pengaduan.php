<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [

        'kode',

        'nama',

        'telepon',

        'alamat',

        'kategori',

        'lokasi',

        'uraian',

        'foto',

        'status',

        'catatan',

    ];

    protected $casts = [

        'created_at' => 'datetime',

        'updated_at' => 'datetime',

    ];
}