<?php

namespace App\Listeners\AlbertHeijn\Guzzle;

use App\Events\AlbertHeijn\Guzzle\FetchedTaxonomyItemsEvent;
use App\Events\AlbertHeijn\TaxonomyNameSearchEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Events\Dispatcher;

class FetchTaxonomyByNameJob
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
    public function handle(TaxonomyNameSearchEvent $event): array
    {
        $result = $this->guzzle->request(
            'GET',
            "https://www.ah.nl/zoeken/api/taxonomy?name=$event->name"
        );

        $body = $result->getBody();
        $items = json_decode((string) $body);

        foreach (array_chunk($items, 10) as $chunkedItems) {
            $event = new FetchedTaxonomyItemsEvent(items: $chunkedItems);

            $this->dispatcher->dispatch($event);
        }

        return $items;
    }
}
