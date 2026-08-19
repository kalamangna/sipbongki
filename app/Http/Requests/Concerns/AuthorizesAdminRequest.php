<?php

namespace App\Http\Requests\Concerns;

/**
 * Menyediakan logika otorisasi terpusat untuk seluruh Form Request admin.
 * Pastikan hanya pengguna yang sudah terautentikasi dan memiliki role
 * admin/operator/pimpinan yang dapat mengirimkan request ini.
 */
trait AuthorizesAdminRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check()
            && in_array(auth()->user()->role, ['admin', 'operator', 'pimpinan'], true);
    }
}
