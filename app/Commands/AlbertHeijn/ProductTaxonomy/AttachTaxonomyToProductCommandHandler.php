<?php

namespace App\Commands\AlbertHeijn\ProductTaxonomy;

use App\Models\ProductTaxonomy;
use Illuminate\Database\QueryException;

class AttachTaxonomyToProductCommandHandler
{
    private ProductTaxonomy $productTaxonomy;

    public function __construct(ProductTaxonomy $productTaxonomy)
    {
        $this->productTaxonomy = $productTaxonomy;
    }

    public function handle(AttachTaxonomyToProductCommand $command): void
    {
        $this->productTaxonomy->fill([
            'product_id' => $command->productId,
            'taxonomy_id' => $command->taxonomyId,
        ]);

        $this->productTaxonomy->save();
    }
}
