<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LowonganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'posisi'        => ['required', 'string', 'max:255'],
            'id_jenis'      => ['required', 'exists:tm_jenis_lowongan,id'],
            'deskripsi'     => ['nullable', 'string'],
            'tags'          => ['nullable', 'array'],
            'tags.*'        => ['string', 'max:100'],
            'lokasi'        => ['nullable', 'string', 'max:150'],
            'tipe_kerja'    => ['nullable', 'string', 'max:100'],
            'tanggal_tutup' => ['nullable', 'date'],
            'link_daftar'   => ['nullable', 'url', 'max:255'],
            'gambar'        => ['nullable', 'image', 'max:2048'],
            'status'        => ['required', 'in:buka,tutup'],
        ];
    }

    protected function prepareForValidation(): void
    {
        // tags dikirim sebagai string koma-separated, convert ke array
        if ($this->filled('tags') && is_string($this->tags)) {
            $tagsArray = array_filter(array_map('trim', explode(',', $this->tags)));
            $this->merge(['tags' => array_values($tagsArray)]);
        }
    }

    public function attributes(): array
    {
        return [
            'posisi'        => 'posisi/judul',
            'id_jenis'      => 'jenis kegiatan',
            'tanggal_tutup' => 'tanggal tutup',
            'link_daftar'   => 'link pendaftaran',
            'tipe_kerja'    => 'tipe kerja',
        ];
    }
}
