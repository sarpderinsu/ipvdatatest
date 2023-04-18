<?php

namespace App\Commands\AlbertHeijn\Taxonomy;

use App\Models\Taxonomy;
use Exception;

class UpdateTaxonomyFetchedCommandHandler
{
    private Taxonomy $taxonomy;

    public function __construct(Taxonomy $taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    /**
     * @throws Exception
     */
    public function handle(UpdateTaxonomyFetchedCommand $command): void
    {
        $taxonomy = $this->taxonomy->newQuery()
            ->where('slugified_name', $command->slugifiedName)
            ->first();

        if ($taxonomy === null) {
            throw new \Exception('Taxonomy ' . $command->slugifiedName . ' not found.');
        }

        $taxonomy->fetched = true;
        $taxonomy->save();
    }
}
