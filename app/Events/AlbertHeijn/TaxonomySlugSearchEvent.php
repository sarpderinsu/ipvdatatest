<?php

namespace App\Events\AlbertHeijn;

class TaxonomySlugSearchEvent
{
    public string $taxonomySlug;
    public int $size;

    public function __construct(string $taxonomySlug, int $size)
    {
        $this->taxonomySlug = $taxonomySlug;
        $this->size = $size;
    }
}
