<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJabatanRequest extends FormRequest
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

            'nama' => [
                'required',
                'string',
                'max:100',
                'unique:jabatans,nama',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:100',
            ],

            'parent_id' => [
                'nullable',
                'exists:jabatans,id',
            ],

            'urutan' => [
                'required',
                'integer',
                'min:1',
            ],

            'is_penandatangan' => [
                'nullable',
                'boolean',
            ],

            'is_struktur' => [
                'nullable',
                'boolean',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],

        ];
    }

    /**
     * Data sebelum divalidasi
     */
    protected function prepareForValidation(): void
    {
        $this->merge([

            'slug' => $this->slug,

            'is_penandatangan' => $this->boolean('is_penandatangan'),

            'is_struktur' => $this->boolean('is_struktur'),

            'aktif' => $this->boolean('aktif'),

        ]);
    }

    /**
     * Pesan Validasi
     */
    public function messages(): array
    {
        return [

            'nama.required' => 'Nama jabatan wajib diisi.',
            'nama.unique'   => 'Nama jabatan sudah digunakan.',
            'nama.max'      => 'Nama jabatan maksimal 100 karakter.',

            'slug.max'      => 'Slug maksimal 100 karakter.',

            'parent_id.exists' => 'Parent jabatan tidak ditemukan.',

            'urutan.required' => 'Urutan jabatan wajib diisi.',
            'urutan.integer'  => 'Urutan harus berupa angka.',
            'urutan.min'      => 'Urutan minimal 1.',

        ];
    }
}