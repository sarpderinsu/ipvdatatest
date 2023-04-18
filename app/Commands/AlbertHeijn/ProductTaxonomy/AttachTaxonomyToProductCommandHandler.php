<?php

namespace App\Commands\AlbertHeijn\ProductTaxonomy;

use App\Events\AlbertHeijn\ProductAttachedToTaxonomyEvent;
use App\Models\ProductTaxonomy;
use Illuminate\Contracts\Events\Dispatcher;

class AttachTaxonomyToProductCommandHandler
{
    private ProductTaxonomy $productTaxonomy;
    private Dispatcher $eventDispatcher;

    public function __construct(ProductTaxonomy $productTaxonomy, Dispatcher $eventDispatcher)
    {
        $this->productTaxonomy = $productTaxonomy;
        $this->eventDispatcher = $eventDispatcher;
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

        $event = new ProductAttachedToTaxonomyEvent(
            taxonomyId: $command->taxonomyId,
            productId: $command->productId,
        );

        $this->eventDispatcher->dispatch($event);
    }
}
