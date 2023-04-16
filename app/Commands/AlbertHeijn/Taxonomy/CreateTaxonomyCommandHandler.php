<?php

namespace App\Commands\AlbertHeijn\Taxonomy;

use App\Models\Taxonomy;

class CreateTaxonomyCommandHandler
{
    private Taxonomy $taxonomy;

    public function __construct(Taxonomy $taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    public function handle(CreateTaxonomyCommand $command): void
    {
        if ($this->taxonomy->newQuery()->where('id', $command->id)->exists()) {
            return;
        }

        $this->taxonomy->fill([
            'id' => $command->id,
            'name' => $command->name,
            'slugified_name' => $command->slugifiedName
        ]);

        $this->taxonomy->save();
    }
}
