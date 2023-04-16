<?php

namespace App\Events\AlbertHeijn\Guzzle;

class FetchedProductItemsEvent
{
    public array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }
}
