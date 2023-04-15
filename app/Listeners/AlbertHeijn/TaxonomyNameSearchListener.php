<?php

namespace App\Listeners\AlbertHeijn;

use App\Events\AlbertHeijn\TaxonomyNameSearchedEvent;
use App\Events\AlbertHeijn\TaxonomyNameSearchEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Events\Dispatcher;

class TaxonomyNameSearchListener
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
            $event = new TaxonomyNameSearchedEvent(items: $chunkedItems);

            $this->dispatcher->dispatch($event);
        }

        return $items;
    }
}
