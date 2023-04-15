<?php

namespace App\Commands\AlbertHeijn\Taxonomy;

class CreateTaxonomyCommand
{
    public int $id;
    public string $name;
    public string $slugifiedName;
    public string $image;
    public bool $active;

    public function __construct(int $id, string $name, string $slugifiedName, string $image, bool $active)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slugifiedName = $slugifiedName;
        $this->image = $image;
        $this->active = $active;
    }
}
