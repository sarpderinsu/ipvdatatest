<?php

namespace App\Listeners\AlbertHeijn\Guzzle;

use App\Commands\AlbertHeijn\Taxonomy\UpdateTaxonomyFetchedCommand;
use App\Events\AlbertHeijn\Guzzle\FetchedProductItemsEvent;
use App\Events\AlbertHeijn\ProductSlugSearchEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Bus\Dispatcher as BusDispatcher;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;

class FetchProductsByTaxonomySlugJob implements ShouldQueue
{
    private Client $guzzle;
    private EventDispatcher $eventDispatcher;
    private BusDispatcher $busDispatcher;

    public function __construct(Client $client, EventDispatcher $eventDispatcher, BusDispatcher $busDispatcher)
    {
        $this->guzzle = $client;
        $this->eventDispatcher = $eventDispatcher;
        $this->busDispatcher = $busDispatcher;
    }

    /**
     * @throws GuzzleException
     */
    public function handle(ProductSlugSearchEvent $event): void
    {
        $result = $this->guzzle->request(
            'GET',
            "https://www.ah.nl/zoeken/api/products/search?taxonomySlug=$event->taxonomySlug&size=$event->size"
        );

        $body = $result->getBody();
        $items = json_decode((string) $body);

        foreach (array_chunk($items->cards, 10) as $chunkedItems) {
            $items = array_map(fn($item) => array_shift($item->products), $chunkedItems);

            $fetchedProductItemsEvent = new FetchedProductItemsEvent(items: $items);

            $this->eventDispatcher->dispatch($fetchedProductItemsEvent);
        }

        $command = new UpdateTaxonomyFetchedCommand(slugifiedName: $event->taxonomySlug);

        $this->busDispatcher->dispatch($command);
    }
}
