<?php

namespace App\Commands\AlbertHeijn\Taxonomy;

use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateTaxonomyFetchedCommand implements ShouldQueue
{
    public string $slugifiedName;

    public function __construct(string $slugifiedName)
    {
        $this->slugifiedName = $slugifiedName;
    }
}
