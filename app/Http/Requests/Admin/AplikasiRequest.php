<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AplikasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'icon_type' => ['required', 'in:material,upload'],
            'icon_material' => ['nullable', 'string', 'required_if:icon_type,material'],
            'icon_bg' => ['nullable', 'string'],
            'icon_color' => ['nullable', 'string'],
            'logo_file' => ['nullable', 'image', 'max:2048', 'required_if:icon_type,upload'],
            'href' => ['required', 'string'],
            'tags' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
