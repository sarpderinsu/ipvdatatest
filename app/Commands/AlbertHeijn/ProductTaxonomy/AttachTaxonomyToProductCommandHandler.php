<?php

namespace App\Commands\AlbertHeijn\ProductTaxonomy;

use App\Models\ProductTaxonomy;

class AttachTaxonomyToProductCommandHandler
{
    private ProductTaxonomy $productTaxonomy;

    public function __construct(ProductTaxonomy $productTaxonomy)
    {
        $this->productTaxonomy = $productTaxonomy;
    }

    public function handle(AttachTaxonomyToProductCommand $command): void
    {
        if ($this->productTaxonomy->newQuery()
            ->where('taxonomy_id', $command->taxonomyId)
            ->where('product_id', $command->productId)
            ->exists()) {
            return;
        }

        $this->productTaxonomy->fill([
            'product_id' => $command->productId,
            'taxonomy_id' => $command->taxonomyId,
        ]);

        $this->productTaxonomy->save();
    }
}
