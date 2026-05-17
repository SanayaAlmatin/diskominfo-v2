<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        $rules = [
            'username'              => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],
            'nama'                  => ['required', 'string', 'max:255'],
            'email'                 => ['nullable', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'no_telp'               => ['nullable', 'string', 'max:20'],
            'alamat'                => ['nullable', 'string'],
            'instansi'              => ['nullable', 'string', 'max:255'],
            'role'                  => ['required', Rule::in(['editor', 'verifikator', 'super-admin'])],
            'photo'                 => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'role_ids'              => ['nullable', 'array'],
            'role_ids.*'            => ['integer', 'exists:roles,id'],
            'password_confirmation' => ['nullable', 'string'],
        ];

        if ($this->isMethod('POST')) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        } else {
            $rules['password'] = ['nullable', 'string', 'min:8', 'confirmed'];
        }

        return $rules;
    }
}
