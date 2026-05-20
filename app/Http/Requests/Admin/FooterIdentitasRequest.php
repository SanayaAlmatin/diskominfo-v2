<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FooterIdentitasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_organisasi' => ['required', 'string', 'max:255'],
            'deskripsi'       => ['required', 'string'],
        ];
    }
}
