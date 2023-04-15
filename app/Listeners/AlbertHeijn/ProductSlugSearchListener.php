<?php

namespace App\Listeners\AlbertHeijn;

use App\Events\AlbertHeijn\ProductSlugSearchedEvent;
use App\Events\AlbertHeijn\ProductSlugSearchEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Events\Dispatcher;

class ProductSlugSearchListener
{
    private Client $guzzle;
    private Dispatcher $dispatcher;

    public function __construct(Client $client, Dispatcher $dispatcher)
    {
        $this->guzzle = $client;
        $this->dispatcher = $dispatcher;
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

            $event = new ProductSlugSearchedEvent(items: $items);

            $this->dispatcher->dispatch($event);
        }
    }
}
