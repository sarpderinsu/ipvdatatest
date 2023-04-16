<?php

namespace App\Listeners\AlbertHeijn;

use App\Commands\AlbertHeijn\ProductTaxonomy\AttachTaxonomyToProductCommand;
use App\Events\AlbertHeijn\AttachTaxonomiesToProductEvent;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;

class AttachTaxonomiesToProductJob implements ShouldQueue
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function handle(AttachTaxonomiesToProductEvent $event): void
    {
        foreach ($event->taxonomyIds as $taxonomyId) {
            $command = new AttachTaxonomyToProductCommand(
                productId: $event->productId,
                taxonomyId: $taxonomyId
            );

            $this->dispatcher->dispatch($command);
        }
    }
}
