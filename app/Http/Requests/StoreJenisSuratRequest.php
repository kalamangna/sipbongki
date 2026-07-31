<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJenisSuratRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            'kode' => 'required|string|max:20|unique:jenis_surats,kode',

            'nama' => 'required|string|max:255',

            'deskripsi' => 'nullable|string',

            'template_view' => 'nullable|string|max:255',

            'kode_nomor' => 'nullable|string|max:50',

            'nomor_urut' => 'nullable|integer|min:0',

            'aktif' => 'nullable|boolean',

        ];
    }

    /**
     * Custom Attribute
     */
    public function attributes(): array
    {
        return [

            'kode' => 'Kode Surat',

            'nama' => 'Nama Surat',

            'deskripsi' => 'Deskripsi',

            'template_view' => 'Template View',

            'kode_nomor' => 'Kode Nomor Surat',

            'nomor_urut' => 'Nomor Urut',

            'aktif' => 'Status Aktif',

        ];
    }
}