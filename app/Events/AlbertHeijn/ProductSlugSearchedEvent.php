<?php

namespace App\Events\AlbertHeijn;

class ProductSlugSearchedEvent
{
    public array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }
}
