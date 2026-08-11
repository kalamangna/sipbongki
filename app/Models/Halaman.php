<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Halaman extends Model
{

    use HasFactory;


    protected $table = 'halamans';



    protected $fillable = [

        'judul',
        'slug',
        'isi',
        'gambar',
        'status'

    ];



}