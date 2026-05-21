<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FooterSosmedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $raw = trim($this->input('maps_embed_url', ''));

        // Auto-extract the src URL if the user pasted a full <iframe> tag
        if ($raw && str_contains($raw, '<iframe')) {
            if (preg_match('/\bsrc=["\']([^"\']+)["\']/', $raw, $m)) {
                $raw = $m[1];
            }
        }

        $this->merge(['maps_embed_url' => $raw ?: null]);
    }

    public function rules(): array
    {
        return [
            'instagram_url'  => ['nullable', 'url', 'max:500'],
            'tiktok_url'     => ['nullable', 'url', 'max:500'],
            'twitter_url'    => ['nullable', 'url', 'max:500'],
            'facebook_url'   => ['nullable', 'url', 'max:500'],
            'youtube_url'    => ['nullable', 'url', 'max:500'],
            'maps_embed_url' => ['nullable', 'string', 'max:2000', function ($attribute, $value, $fail) {
                if ($value && ! str_starts_with(trim($value), 'https://www.google.com/maps/embed')) {
                    $fail('URL peta harus berupa embed URL Google Maps (diawali dengan https://www.google.com/maps/embed). Buka Google Maps → Bagikan → Sematkan peta → salin URL dari atribut src pada tag <iframe>.');
                }
            }],
        ];
    }
}
