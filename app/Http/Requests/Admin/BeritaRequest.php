<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BeritaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $newsId = $this->route('berita')?->id ?? $this->route('berita');

        return [
            'title'             => ['required', 'string', 'max:255'],
            'subtitle'          => ['nullable', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255'],
            'content'           => ['required', 'string'],
            'excerpt'           => ['nullable', 'string', 'max:500'],
            'description_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_caption'     => ['nullable', 'string', 'max:255'],
            'status'            => ['required', 'in:0,1'],
            'is_headline'       => ['nullable', 'boolean'],
            'published_at'      => ['nullable', 'date'],
            'category_id'       => ['required', 'integer', 'exists:tm_categories,id'],
            'meta_title'        => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string', 'max:500'],
            'tags'              => ['nullable', 'array'],
            'tags.*'            => ['integer', 'exists:tm_tags,id'],
            'gallery_images'    => ['nullable', 'array'],
            'gallery_images.*'  => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    protected function prepareForValidation(): void
    {
        // Auto-generate slug jika kosong
        if (empty($this->slug)) {
            $slug = Str::slug($this->title);
            if (empty($slug)) {
                $slug = 'berita-' . time();
            }
            $this->merge(['slug' => $slug]);
        }

        $this->merge([
            'is_headline' => $this->boolean('is_headline'),
        ]);
    }

    public function attributes(): array
    {
        return [
            'title'             => 'judul berita',
            'slug'              => 'slug',
            'content'           => 'konten berita',
            'excerpt'           => 'ringkasan',
            'description_image' => 'gambar utama',
            'image_caption'     => 'deskripsi gambar',
            'status'            => 'status',
            'published_at'      => 'tanggal publish',
            'meta_title'        => 'meta title',
            'meta_description'  => 'meta description',
        ];
    }
}
