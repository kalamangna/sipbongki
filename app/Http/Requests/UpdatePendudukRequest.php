<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\AuthorizesAdminRequest;
use Illuminate\Validation\Rule;

class UpdatePendudukRequest extends FormRequest
{
    use AuthorizesAdminRequest;



    public function rules(): array
    {
        return [

            'nik' => [

                'required',

                'digits:16',

                Rule::unique(
                    'penduduks',
                    'nik'
                )->ignore(
                    $this->penduduk->id
                ),

            ],



            'nama_lengkap' =>
            'required|string|max:255',


            'jenis_kelamin' =>
            'required|in:L,P',


            'tempat_lahir' =>
            'required|string|max:100',


            'tanggal_lahir' =>
            'required|date',



            'agama' =>
            'nullable|string|max:50',


            'status_perkawinan' =>
            'nullable|string|max:50',


            'pendidikan' =>
            'nullable|string|max:100',


            'pekerjaan' =>
            'nullable|string|max:100',



            'alamat' =>
            'nullable|string',



            'rt' => [
                'required',
                'string',
                'max:3'
            ],


            'rw' => [
                'required',
                'string',
                'max:3'
            ],



            'lingkungan_id' => [
                'required',
                'exists:lingkungans,id'
            ],



            'kartu_keluarga_id' =>
            'nullable|exists:kartu_keluargas,id',

            'hubungan_keluarga' =>
            'nullable|string|max:50',



            'telepon' =>
            'nullable|string|max:20',



            'email' => [

                'nullable',

                'email',

                'max:255',

                Rule::unique(
                    'penduduks',
                    'email'
                )->ignore(
                    $this->penduduk->id
                ),

            ],



            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ],



            'aktif' =>
            'nullable|boolean',

        ];
    }
}