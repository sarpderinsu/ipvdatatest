<?php

namespace App\Commands\AlbertHeijn\ProductTaxonomy;

use Illuminate\Contracts\Queue\ShouldQueue;

class AttachTaxonomyToProductCommand implements ShouldQueue
{
    public int $productId;
    public int $taxonomyId;

    public function __construct(int $productId, int $taxonomyId)
    {
        $this->productId = $productId;
        $this->taxonomyId = $taxonomyId;
    }
}
