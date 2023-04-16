<?php

namespace App\Commands\AlbertHeijn\Taxonomy;

use App\Models\Taxonomy;

class UpdateTaxonomyFetchedCommandHandler
{
    private Taxonomy $taxonomy;

    public function __construct(Taxonomy $taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    public function handle(UpdateTaxonomyFetchedCommand $command): void
    {
        $this->taxonomy->newQuery()
            ->where('slugified_name', $command->slugifiedName)
            ->update(['fetched' => true]);
    }
}
