<?php

namespace App\Listeners\AlbertHeijn\Guzzle;

use App\Events\AlbertHeijn\Guzzle\FetchedProductItemsEvent;
use App\Events\AlbertHeijn\ProductSlugSearchEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;

class FetchProductsByTaxonomySlugJob implements ShouldQueue
{
    private Client $guzzle;
    private EventDispatcher $eventDispatcher;

    public function __construct(Client $client, EventDispatcher $eventDispatcher)
    {
        $this->guzzle = $client;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @throws GuzzleException
     */
    public function handle(ProductSlugSearchEvent $event): void
    {
        $result = $this->guzzle->request(
            'GET',
            "https://www.ah.nl/zoeken/api/products/search?taxonomySlug=$event->taxonomySlug&size=$event->size&page=$event->page"
        );

        $body = $result->getBody();
        $fetched = json_decode((string) $body);

        if (($event->page + 1) < $fetched->page->totalPages) {
            $productSlugSearchEvent = new ProductSlugSearchEvent(
                taxonomySlug: $event->taxonomySlug,
                size: $event->size,
                page: ($event->page + 1),
            );

            $this->eventDispatcher->dispatch($productSlugSearchEvent);
        }

        foreach (array_chunk($fetched->cards, 10) as $chunkedItems) {
            $items = array_map(fn($item) => array_shift($item->products), $chunkedItems);

            $fetchedProductItemsEvent = new FetchedProductItemsEvent(items: $items);

            $this->eventDispatcher->dispatch($fetchedProductItemsEvent);
        }
    }
}
