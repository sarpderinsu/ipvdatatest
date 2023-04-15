<?php

namespace App\Http\Requests\AlbertHeijn;

use Illuminate\Foundation\Http\FormRequest;

class TaxonomySlugSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'taxonomySlug' => 'required|string',
            'size' => 'integer|max:1000',
        ];
    }
}
