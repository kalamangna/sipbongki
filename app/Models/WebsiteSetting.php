<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $table = 'website_settings';

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Identitas
        |--------------------------------------------------------------------------
        */

        'nama_website',
        'nama_kelurahan',
        'logo',
        'favicon',
        'deskripsi',

        /*
        |--------------------------------------------------------------------------
        | Hero
        |--------------------------------------------------------------------------
        */

        'badge',
        'judul_hero',
        'subjudul_hero',
        'deskripsi_hero',
        'gambar_hero',

        'hero_button_1_text',
        'hero_button_1_link',

        'hero_button_2_text',
        'hero_button_2_link',

        /*
        |--------------------------------------------------------------------------
        | Kontak
        |--------------------------------------------------------------------------
        */

        'alamat',
        'telepon',
        'whatsapp',
        'email',
        'google_maps',
        'jam_pelayanan',

        /*
        |--------------------------------------------------------------------------
        | Media Sosial
        |--------------------------------------------------------------------------
        */

        'facebook',
        'instagram',
        'youtube',

        /*
        |--------------------------------------------------------------------------
        | Footer
        |--------------------------------------------------------------------------
        */

        'footer_text',
        'copyright',

       /*
|--------------------------------------------------------------------------
| SEO
|--------------------------------------------------------------------------
*/

'meta_title',
'meta_description',
'meta_keyword',

'tampilkan_berita',
'tampilkan_pengumuman',
'tampilkan_agenda',
'tampilkan_galeri',
'tampilkan_pengaduan',
'tampilkan_statistik',
'tampilkan_layanan',
    ];
}