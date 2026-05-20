<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FooterKontakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'alamat'  => ['required', 'string'],
            'telepon' => ['required', 'string', 'max:50'],
            'email'   => ['required', 'email', 'max:255'],
        ];
    }
}
