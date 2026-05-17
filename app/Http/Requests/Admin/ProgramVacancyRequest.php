<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProgramVacancyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        $imageRequired = $this->isMethod('POST') ? 'required' : 'nullable';

        return [
            'description' => ['nullable', 'string'],
            'image'       => [$imageRequired, 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'link_url'    => ['nullable', 'url', 'max:255'],
            'is_active'   => ['nullable', 'boolean'],
        ];
    }
}
