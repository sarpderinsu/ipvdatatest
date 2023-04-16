<?php

namespace App\Commands\AlbertHeijn\Taxonomy;

use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTaxonomyCommand implements ShouldQueue
{
    public int $id;
    public string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
