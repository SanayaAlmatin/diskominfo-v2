<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VisiMisiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'tipe'       => ['required', 'in:visi,misi'],
            'konten'     => ['required', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active'  => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'tipe.required'   => 'Tipe wajib dipilih.',
            'tipe.in'         => 'Tipe harus berupa visi atau misi.',
            'konten.required' => 'Konten wajib diisi.',
        ];
    }
}
