<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLingkunganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode' => 'required|string|max:20|unique:lingkungans,kode',
            'nama' => 'required|string|max:100',
            'ketua_lingkungan' => 'nullable|string|max:100',
            'telepon' => 'nullable|string|max:20',
            'keterangan' => 'nullable|string',
            'status' => 'required|boolean',
        ];
    }
}