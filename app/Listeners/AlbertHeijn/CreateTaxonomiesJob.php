<?php

namespace App\Listeners\AlbertHeijn;

use App\Commands\AlbertHeijn\Taxonomy\CreateTaxonomyCommand;
use App\Events\AlbertHeijn\Guzzle\FetchedTaxonomyItemsEvent;
use Illuminate\Contracts\Bus\Dispatcher;

class CreateTaxonomiesJob
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function handle(FetchedTaxonomyItemsEvent $event): void
    {
        foreach ($event->items as $item) {
            $command = new CreateTaxonomyCommand(
                id: $item->id,
                name: $item->name,
                slugifiedName: $item->slugifiedName
            );

            $this->dispatcher->dispatch($command);
        }
    }
}
