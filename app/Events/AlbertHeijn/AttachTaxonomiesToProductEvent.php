<?php

namespace App\Events\AlbertHeijn;

class AttachTaxonomiesToProductEvent
{
    public int $productId;
    public array $taxonomyIds;

    public function __construct(int $productId, array $taxonomyIds)
    {
        $this->productId = $productId;
        $this->taxonomyIds = $taxonomyIds;
    }
}
