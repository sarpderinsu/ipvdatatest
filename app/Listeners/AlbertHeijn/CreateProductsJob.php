<?php

namespace App\Listeners\AlbertHeijn;

use App\Commands\AlbertHeijn\Product\CreateProductCommand;
use App\Events\AlbertHeijn\AttachTaxonomiesToProductEvent;
use App\Events\AlbertHeijn\Guzzle\FetchedProductItemsEvent;
use Illuminate\Contracts\Bus\Dispatcher as BusDispatcher;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateProductsJob implements ShouldQueue
{
    private BusDispatcher $busDispatcher;
    private EventDispatcher $eventDispatcher;

    public function __construct(BusDispatcher $busDispatcher, EventDispatcher $eventDispatcher)
    {
        $this->busDispatcher = $busDispatcher;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(FetchedProductItemsEvent $event): void
    {
        foreach ($event->items as $item) {
            $createProductCommand = new CreateProductCommand(
                id: $item->id,
                title: $item->title,
                link: $item->link,
                image: array_shift($item->images)->url,
                brand: $item->brand,
                category: $item->category,
                price: (array) $item->price,
                discount: (array) ($item->discount ?? null)
            );

            $attachTaxonomiesToProductEvent = new AttachTaxonomiesToProductEvent(
                productId: $item->id,
                taxonomyIds: collect($item->taxonomies)->pluck('id')->toArray()
            );

            $this->busDispatcher->dispatch($createProductCommand);
            $this->eventDispatcher->dispatch($attachTaxonomiesToProductEvent);
        }
    }
}
