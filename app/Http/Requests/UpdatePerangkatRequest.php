<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\AuthorizesAdminRequest;

class UpdatePerangkatRequest extends FormRequest
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
            'nama_lengkap' => [
                'required',
                'string',
                'max:255',
            ],
            'nip' => [
                'nullable',
                'string',
                'max:30',
            ],
            'jabatan_id' => [
                'nullable',
                'exists:jabatans,id',
            ],
            'jabatan_struktur_id' => [
                'nullable',
                'exists:jabatans,id',
            ],
            'level' => [
                'required',
                'integer',
                'min:1',
                'max:99',
            ],
            'jenis_kelamin' => [
                'nullable',
                'in:L,P',
            ],
            'tempat_lahir' => [
                'nullable',
                'string',
                'max:100',
            ],
            'tanggal_lahir' => [
                'nullable',
                'date',
            ],
            'pendidikan' => [
                'nullable',
                'string',
                'max:100',
            ],
            'telepon' => [
                'nullable',
                'string',
                'max:20',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
            'alamat' => [
                'nullable',
                'string',
                'max:500',
            ],
            'tanggal_mulai_jabatan' => [
                'nullable',
                'date',
            ],
            'tanggal_selesai_jabatan' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai_jabatan',
            ],
            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'aktif' => [
                'nullable',
                'boolean',
            ],
            'keterangan' => [
                'nullable',
                'string',
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
            'nama_lengkap' => 'Nama Lengkap',
            'nip' => 'NIP',
            'niap' => 'NIAP',
            'jabatan_id' => 'Jabatan Pokok',
            'jabatan_struktur_id' => 'Jabatan Struktur',
            'level' => 'Level Struktur',
            'jenis_kelamin' => 'Jenis Kelamin',
            'telepon' => 'Nomor Telepon',
            'email' => 'Email',
            'foto' => 'Foto Aparatur',
            'tanggal_selesai_jabatan' => 'Tanggal Selesai Jabatan',
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
            'nama_lengkap.required' => 'Nama lengkap aparatur wajib diisi.',
            'level.required' => 'Level struktur organisasi wajib dipilih.',
            'email.email' => 'Format alamat email tidak valid.',
            'foto.image' => 'Berkas foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus berupa JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'tanggal_selesai_jabatan.after_or_equal' => 'Tanggal selesai jabatan harus sama dengan atau setelah tanggal mulai jabatan.',
        ];
    }
}
