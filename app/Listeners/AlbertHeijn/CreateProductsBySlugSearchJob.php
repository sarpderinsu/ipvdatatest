<?php

namespace App\Listeners\AlbertHeijn;

use App\Commands\AlbertHeijn\Product\CreateProductCommand;
use App\Events\AlbertHeijn\ProductSlugSearchedEvent;
use Illuminate\Contracts\Bus\Dispatcher;

class CreateProductsBySlugSearchJob
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function handle(ProductSlugSearchedEvent $event): void
    {
        foreach ($event->items as $item) {
            $command = new CreateProductCommand(
                id: $item->id,
                title: $item->title,
                link: $item->link,
                image: array_shift($item->images)->url,
                brand: $item->brand,
                category: $item->category,
                price: (array) $item->price,
                discount: (array) ($item->discount ?? null)
            );

            $this->dispatcher->dispatch($command);
        }
    }
}
