<?php

namespace App\Events\AlbertHeijn;

class TaxonomyNameSearchedEvent
{
    public array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }
}
