<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'id',
        'title',
        'link',
        'image',
        'brand',
        'category',
        'price',
        'discount',
    ];

    protected $casts = [
        'price' => 'array',
        'discount' => 'array',
    ];

    public function taxonomy(): BelongsToMany
    {
        return $this->belongsToMany(Taxonomy::class);
    }
}
