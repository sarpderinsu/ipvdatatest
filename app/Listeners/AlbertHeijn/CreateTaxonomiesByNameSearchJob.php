<?php

namespace App\Listeners\AlbertHeijn;

use App\Commands\AlbertHeijn\Taxonomy\CreateTaxonomyCommand;
use App\Events\AlbertHeijn\TaxonomyNameSearchedEvent;
use Illuminate\Contracts\Bus\Dispatcher;

class CreateTaxonomiesByNameSearchJob
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function handle(TaxonomyNameSearchedEvent $event): void
    {
        foreach ($event->items as $item) {
            $command = new CreateTaxonomyCommand(
                id: $item->id,
                name: $item->name,
                slugifiedName: $item->slugifiedName,
                image: $item->image,
                active: $item->active
            );

            $this->dispatcher->dispatch($command);
        }
    }
}
