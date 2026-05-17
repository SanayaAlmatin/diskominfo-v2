<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SekilasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
            'gambar'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Konten wajib diisi.',
            'gambar.image'     => 'File harus berupa gambar.',
            'gambar.max'       => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
