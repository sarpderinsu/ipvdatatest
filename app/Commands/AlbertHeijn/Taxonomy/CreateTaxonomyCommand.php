<?php

namespace App\Commands\AlbertHeijn\Taxonomy;

use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTaxonomyCommand implements ShouldQueue
{
    public int $id;
    public string $name;
    public string $slugifiedName;

    public function __construct(int $id, string $name, string $slugifiedName)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slugifiedName = $slugifiedName;
    }
}
