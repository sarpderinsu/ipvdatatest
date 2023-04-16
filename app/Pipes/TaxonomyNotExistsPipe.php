<?php

namespace App\Pipes;

use App\Commands\AlbertHeijn\Taxonomy\CreateTaxonomyCommand;
use App\Models\Taxonomy;
use Closure;

class TaxonomyNotExistsPipe
{
    private Taxonomy $taxonomy;

    public function __construct(Taxonomy $taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    public function handle(CreateTaxonomyCommand $command, Closure $next)
    {
        if ($this->taxonomy->newQuery()->where('id', $command->id)->exists()) {
            return null;
        }

        return $next($command);
    }
}
