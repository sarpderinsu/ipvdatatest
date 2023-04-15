<?php

namespace App\Events\AlbertHeijn;

class TaxonomyNameSearchEvent
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
