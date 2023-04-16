<?php

namespace App\Pipes;

use App\Commands\AlbertHeijn\ProductTaxonomy\AttachTaxonomyToProductCommand;
use App\Models\ProductTaxonomy;
use Closure;

class ProductTaxonomyNotExistsPipe
{
    private ProductTaxonomy $productTaxonomy;

    public function __construct(ProductTaxonomy $productTaxonomy)
    {
        $this->productTaxonomy = $productTaxonomy;
    }

    public function handle(AttachTaxonomyToProductCommand $command, Closure $next)
    {
        if ($this->productTaxonomy->newQuery()
            ->where('product_id', $command->productId)
            ->where('taxonomy_id', $command->taxonomyId)
            ->exists()) {
            return null;
        }

        return $next($command);
    }
}
