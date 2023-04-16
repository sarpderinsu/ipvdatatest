<?php

namespace App\Events\AlbertHeijn\Guzzle;

class FetchedTaxonomyItemsEvent
{
    public array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }
}
