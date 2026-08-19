<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\AuthorizesAdminRequest;

class StoreJenisSuratRequest extends FormRequest
{
    use AuthorizesAdminRequest;

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            'kode' => 'required|string|max:20|unique:jenis_surats,kode',

            'nama' => 'required|string|max:255',

            'deskripsi' => 'nullable|string',

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

            'kode_nomor' => 'Kode Nomor Surat',

            'nomor_urut' => 'Nomor Urut',

            'aktif' => 'Status Aktif',

        ];
    }
}