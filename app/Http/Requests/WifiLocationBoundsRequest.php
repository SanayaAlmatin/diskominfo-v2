<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WifiLocationBoundsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'north' => ['required', 'numeric', 'min:-90', 'max:90'],
            'south' => ['required', 'numeric', 'min:-90', 'max:90'],
            'east' => ['required', 'numeric', 'min:-180', 'max:180'],
            'west' => ['required', 'numeric', 'min:-180', 'max:180'],
            'zoom' => ['nullable', 'integer', 'min:1', 'max:20'],
        ];
    }
}
