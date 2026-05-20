<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FooterUtilitasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'privacy_policy_url' => ['nullable', 'url', 'max:500'],
            'terms_url'          => ['nullable', 'url', 'max:500'],
            'sitemap_url'        => ['nullable', 'url', 'max:500'],
            'copyright_text'     => ['nullable', 'string', 'max:500'],
        ];
    }
}
