<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FooterSosmedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'instagram_url'  => ['nullable', 'url', 'max:500'],
            'tiktok_url'     => ['nullable', 'url', 'max:500'],
            'twitter_url'    => ['nullable', 'url', 'max:500'],
            'facebook_url'   => ['nullable', 'url', 'max:500'],
            'youtube_url'    => ['nullable', 'url', 'max:500'],
            'maps_embed_url' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
