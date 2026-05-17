<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InfrastrukturTikRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'kategori'   => ['required', 'string', 'max:100'],
            'label'      => ['required', 'string', 'max:255'],
            'nilai'      => ['required', 'string', 'max:100'],
            'satuan'     => ['nullable', 'string', 'max:50'],
            'icon'       => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active'  => ['nullable', 'boolean'],
        ];
    }
}
