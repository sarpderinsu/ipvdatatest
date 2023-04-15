<?php

namespace App\Providers;

use App\Events\AlbertHeijn\ProductSlugSearchedEvent;
use App\Events\AlbertHeijn\ProductSlugSearchEvent;
use App\Events\AlbertHeijn\TaxonomyNameSearchedEvent;
use App\Events\AlbertHeijn\TaxonomyNameSearchEvent;
use App\Listeners\AlbertHeijn\CreateProductsBySlugSearchJob;
use App\Listeners\AlbertHeijn\CreateTaxonomiesByNameSearchJob;
use App\Listeners\AlbertHeijn\ProductSlugSearchListener;
use App\Listeners\AlbertHeijn\TaxonomyNameSearchListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ProductSlugSearchEvent::class => [
            ProductSlugSearchListener::class
        ],
        ProductSlugSearchedEvent::class => [
            CreateProductsBySlugSearchJob::class
        ],
        TaxonomyNameSearchEvent::class => [
            TaxonomyNameSearchListener::class
        ],
        TaxonomyNameSearchedEvent::class => [
            CreateTaxonomiesByNameSearchJob::class
        ]
    ];
}
