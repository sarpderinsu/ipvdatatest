<?php

namespace App\Http\Requests\AlbertHeijn;

use Illuminate\Foundation\Http\FormRequest;

class ProductSlugSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'taxonomySlug' => 'required|string',
        ];
    }
}
