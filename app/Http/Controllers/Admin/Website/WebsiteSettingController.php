<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Pengaturan
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $setting = WebsiteSetting::first();

        return view(
            'admin.website.pengaturan.index',
            compact('setting')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Form Edit
    |--------------------------------------------------------------------------
    */

    public function edit()
    {
        $setting = WebsiteSetting::first();

        return view(
            'admin.website.pengaturan.edit',
            compact('setting')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Data
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Identitas
            |--------------------------------------------------------------------------
            */

            'nama_website'      => 'required|string|max:255',
            'nama_kelurahan'    => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',

            'logo'              => 'nullable|image|max:2048',
            'favicon'           => 'nullable|image|max:1024',

            /*
            |--------------------------------------------------------------------------
            | Hero
            |--------------------------------------------------------------------------
            */

            'badge'                 => 'nullable|string|max:255',
            'judul_hero'            => 'nullable|string|max:255',
            'subjudul_hero'         => 'nullable|string|max:255',
            'deskripsi_hero'        => 'nullable|string',

            'gambar_hero'           => 'nullable|image|max:4096',

            'hero_button_1_text'    => 'nullable|string|max:100',
            'hero_button_1_link'    => 'nullable|string|max:255',

            'hero_button_2_text'    => 'nullable|string|max:100',
            'hero_button_2_link'    => 'nullable|string|max:255',

            /*
            |--------------------------------------------------------------------------
            | Kontak
            |--------------------------------------------------------------------------
            */

            'alamat'            => 'nullable|string',
            'telepon'           => 'nullable|string|max:30',
            'whatsapp'          => 'nullable|string|max:30',
            'email'             => 'nullable|email',
            'google_maps'       => 'nullable|string',
            'jam_pelayanan'     => 'nullable|string|max:255',

            /*
            |--------------------------------------------------------------------------
            | Media Sosial
            |--------------------------------------------------------------------------
            */

            'facebook'          => 'nullable|string|max:255',
            'instagram'         => 'nullable|string|max:255',
            'youtube'           => 'nullable|string|max:255',

            /*
            |--------------------------------------------------------------------------
            | Footer
            |--------------------------------------------------------------------------
            */

            'footer_text'       => 'nullable|string',
            'copyright'         => 'nullable|string|max:255',

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
            'meta_keyword'      => 'nullable|string|max:255',

            'tampilkan_berita'      => 'nullable|boolean',
            'tampilkan_pengumuman'  => 'nullable|boolean',
            'tampilkan_agenda'      => 'nullable|boolean',
            'tampilkan_galeri'      => 'nullable|boolean',
            'tampilkan_pengaduan'   => 'nullable|boolean',
            'tampilkan_statistik'   => 'nullable|boolean',
            'tampilkan_layanan'     => 'nullable|boolean', 
        ]);

        $setting = WebsiteSetting::first();

        if (!$setting) {
            $setting = new WebsiteSetting();
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('website', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Favicon
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('favicon')) {

            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }

            $validated['favicon'] = $request
                ->file('favicon')
                ->store('website', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Hero Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('gambar_hero')) {

            if ($setting->gambar_hero) {
                Storage::disk('public')->delete($setting->gambar_hero);
            }

            $validated['gambar_hero'] = $request
                ->file('gambar_hero')
                ->store('website', 'public');
        }

        $validated['tampilkan_berita'] = $request->has('tampilkan_berita');
        $validated['tampilkan_pengumuman'] = $request->has('tampilkan_pengumuman');
        $validated['tampilkan_agenda'] = $request->has('tampilkan_agenda');
        $validated['tampilkan_galeri'] = $request->has('tampilkan_galeri');
        $validated['tampilkan_pengaduan'] = $request->has('tampilkan_pengaduan');
        $validated['tampilkan_statistik']   = $request->has('tampilkan_statistik');
        $validated['tampilkan_layanan']     = $request->has('tampilkan_layanan');

        $setting->fill($validated);

        $setting->save();

        return redirect()
            ->route('admin.website.pengaturan.index')
            ->with(
                'success',
                'Pengaturan website berhasil diperbarui.'
            );
    }
}