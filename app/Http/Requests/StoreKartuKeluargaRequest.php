<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\AuthorizesAdminRequest;

class StoreKartuKeluargaRequest extends FormRequest
{
    use AuthorizesAdminRequest;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'no_kk' => [
                'required',
                'numeric',
                'digits:16',
                'unique:kartu_keluargas,no_kk',
            ],
            'kepala_keluarga_id' => [
                'nullable',
                'exists:penduduks,id',
            ],
            'alamat' => [
                'nullable',
                'string',
                'max:500',
            ],
            'rt' => [
                'nullable',
                'string',
                'max:5',
            ],
            'rw' => [
                'nullable',
                'string',
                'max:5',
            ],
            'lingkungan_id' => [
                'nullable',
                'exists:lingkungans,id',
            ],
            'anggota' => [
                'nullable',
                'array',
            ],
            'anggota.*.penduduk_id' => [
                'required',
                'exists:penduduks,id',
            ],
            'anggota.*.hubungan' => [
                'required',
                'string',
                'max:100',
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'no_kk' => 'Nomor Kartu Keluarga',
            'kepala_keluarga_id' => 'Kepala Keluarga',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
            'lingkungan_id' => 'Lingkungan',
            'anggota' => 'Anggota Keluarga',
            'anggota.*.penduduk_id' => 'Anggota Keluarga',
            'anggota.*.hubungan' => 'Hubungan Keluarga',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'no_kk.required' => 'Nomor Kartu Keluarga wajib diisi.',
            'no_kk.numeric' => 'Nomor Kartu Keluarga harus berupa angka.',
            'no_kk.digits' => 'Nomor Kartu Keluarga harus tepat 16 digit angka.',
            'no_kk.unique' => 'Nomor Kartu Keluarga sudah terdaftar di sistem.',
            'kepala_keluarga_id.exists' => 'Data Kepala Keluarga yang dipilih tidak ditemukan.',
            'lingkungan_id.exists' => 'Lingkungan yang dipilih tidak valid.',
            'anggota.*.penduduk_id.required' => 'Pilihan anggota keluarga wajib dipilih.',
            'anggota.*.penduduk_id.exists' => 'Data penduduk anggota keluarga tidak valid.',
            'anggota.*.hubungan.required' => 'Hubungan keluarga wajib diisi.',
        ];
    }
}
