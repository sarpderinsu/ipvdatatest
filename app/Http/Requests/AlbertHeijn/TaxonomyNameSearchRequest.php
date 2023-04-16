<?php

namespace App\Http\Requests\AlbertHeijn;

use Illuminate\Foundation\Http\FormRequest;

class TaxonomyNameSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
