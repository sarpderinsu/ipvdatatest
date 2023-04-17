<?php

namespace App\Commands\AlbertHeijn\Taxonomy;

class UpdateTaxonomyFetchedCommand
{
    public string $slugifiedName;

    public function __construct(string $slugifiedName)
    {
        $this->slugifiedName = $slugifiedName;
    }
}
