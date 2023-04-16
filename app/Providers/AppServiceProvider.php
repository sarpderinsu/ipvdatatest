<?php

namespace App\Providers;

use App\Commands\AlbertHeijn\Product\CreateProductCommand;
use App\Commands\AlbertHeijn\Product\CreateProductCommandHandler;
use App\Commands\AlbertHeijn\ProductTaxonomy\AttachTaxonomyToProductCommand;
use App\Commands\AlbertHeijn\ProductTaxonomy\AttachTaxonomyToProductCommandHandler;
use App\Commands\AlbertHeijn\Taxonomy\CreateTaxonomyCommand;
use App\Commands\AlbertHeijn\Taxonomy\CreateTaxonomyCommandHandler;
use App\Commands\AlbertHeijn\Taxonomy\UpdateTaxonomyFetchedCommand;
use App\Commands\AlbertHeijn\Taxonomy\UpdateTaxonomyFetchedCommandHandler;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(Dispatcher $dispatcher): void
    {
        $dispatcher->map([
            CreateProductCommand::class => CreateProductCommandHandler::class,
            CreateTaxonomyCommand::class => CreateTaxonomyCommandHandler::class,
            UpdateTaxonomyFetchedCommand::class => UpdateTaxonomyFetchedCommandHandler::class,
            AttachTaxonomyToProductCommand::class => AttachTaxonomyToProductCommandHandler::class
        ]);
    }
}
