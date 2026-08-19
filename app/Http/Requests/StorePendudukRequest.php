<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\AuthorizesAdminRequest;

class StorePendudukRequest extends FormRequest
{
    use AuthorizesAdminRequest;


    public function rules(): array
    {
        return [

            'nik' => [
                'required',
                'digits:16',
                'unique:penduduks,nik'
            ],


            'nama_lengkap' => [
                'required',
                'string',
                'max:255'
            ],


            'jenis_kelamin' => [
                'required',
                'in:L,P'
            ],


            'tempat_lahir' => [
                'required',
                'string',
                'max:100'
            ],


            'tanggal_lahir' => [
                'required',
                'date'
            ],



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



            'kartu_keluarga_id' => [
                'nullable',
                'exists:kartu_keluargas,id'
            ],



            'telepon' =>
            'nullable|string|max:20',


            'email' =>
            'nullable|email|max:255|unique:penduduks,email',



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