<?php

namespace App\Commands\AlbertHeijn\Taxonomy;

use App\Models\Taxonomy;
use Illuminate\Database\QueryException;

class CreateTaxonomyCommandHandler
{
    private Taxonomy $taxonomy;

    public function __construct(Taxonomy $taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    public function handle(CreateTaxonomyCommand $command): void
    {
        $this->taxonomy->fill([
            'id' => $command->id,
            'name' => $command->name,
        ]);

        $this->taxonomy->save();
    }
}
