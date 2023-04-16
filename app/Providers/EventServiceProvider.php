<?php

namespace App\Providers;

use App\Events\AlbertHeijn\AttachTaxonomiesToProductEvent;
use App\Events\AlbertHeijn\Guzzle\FetchedProductItemsEvent;
use App\Events\AlbertHeijn\Guzzle\FetchedTaxonomyItemsEvent;
use App\Events\AlbertHeijn\ProductSlugSearchEvent;
use App\Events\AlbertHeijn\TaxonomyNameSearchEvent;
use App\Listeners\AlbertHeijn\AttachTaxonomiesToProductJob;
use App\Listeners\AlbertHeijn\CreateProductsJob;
use App\Listeners\AlbertHeijn\CreateTaxonomiesJob;
use App\Listeners\AlbertHeijn\Guzzle\FetchProductsByTaxonomySlugJob;
use App\Listeners\AlbertHeijn\Guzzle\FetchTaxonomyByNameJob;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        AttachTaxonomiesToProductEvent::class => [
            AttachTaxonomiesToProductJob::class
        ],
        ProductSlugSearchEvent::class => [
            FetchProductsByTaxonomySlugJob::class
        ],
        TaxonomyNameSearchEvent::class => [
            FetchTaxonomyByNameJob::class
        ],
        FetchedProductItemsEvent::class => [
            CreateProductsJob::class
        ],
        FetchedTaxonomyItemsEvent::class => [
            CreateTaxonomiesJob::class
        ]
    ];
}
