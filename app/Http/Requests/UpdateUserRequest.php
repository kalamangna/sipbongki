<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user') instanceof \App\Models\User 
            ? $this->route('user')->id 
            : $this->route('user');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'alpha_dash',
                Rule::unique('users', 'username')->ignore($userId),
            ],
            'role' => [
                'required',
                'string',
                'in:admin,operator,pimpinan',
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
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
            'name' => 'Nama Lengkap',
            'username' => 'Username',
            'role' => 'Peran (Role)',
            'password' => 'Password',
            'password_confirmation' => 'Konfirmasi Password',
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
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda strip (-), dan garis bawah (_).',
            'username.unique' => 'Username sudah digunakan oleh akun lain.',
            'role.required' => 'Role/hak akses wajib dipilih.',
            'role.in' => 'Role yang dipilih tidak valid (harus Admin, Operator, atau Pimpinan).',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ];
    }
}
