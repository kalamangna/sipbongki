<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;


    protected $table = 'agendas';


    protected $fillable = [

        'judul',
        'deskripsi',
        'tanggal',
        'waktu',
        'lokasi',
        'status',

    ];



    protected $casts = [

        'tanggal' => 'date',

    ];

}