<?php

namespace App\Listeners\AlbertHeijn;

use App\Commands\AlbertHeijn\Taxonomy\CreateTaxonomyCommand;
use App\Events\AlbertHeijn\Guzzle\FetchedTaxonomyItemsEvent;
use App\Pipes\TaxonomyNotExistsPipe;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTaxonomiesJob implements ShouldQueue
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
            );

            $this->dispatcher->pipeThrough([TaxonomyNotExistsPipe::class])->dispatch($command);
        }
    }
}
