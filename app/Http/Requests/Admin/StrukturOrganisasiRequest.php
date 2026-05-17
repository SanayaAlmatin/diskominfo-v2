<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StrukturOrganisasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'tahun'      => ['required', 'digits:4', 'integer'],
            'nama_sotk'  => ['required', 'string', 'max:255'],
            'deskripsi'  => ['nullable', 'string'],
            'gambar'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:5120'],
            'is_current' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
