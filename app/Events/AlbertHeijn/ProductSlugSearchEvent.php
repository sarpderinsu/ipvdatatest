<?php

namespace App\Events\AlbertHeijn;

class ProductSlugSearchEvent
{
    public string $taxonomySlug;
    public int $size;
    public int $page;

    public function __construct(string $taxonomySlug, int $size = 1000, int $page = 0)
    {
        $this->taxonomySlug = $taxonomySlug;
        $this->size = $size;
        $this->page = $page;
    }
}
