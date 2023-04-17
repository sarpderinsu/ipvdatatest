<?php

namespace App\Http\Controllers;

use App\Commands\AlbertHeijn\Taxonomy\UpdateTaxonomyFetchedCommand;
use App\Events\AlbertHeijn\ProductSlugSearchEvent;
use App\Events\AlbertHeijn\TaxonomyNameSearchEvent;
use App\Http\Requests\AlbertHeijn\ProductSlugSearchRequest;
use App\Http\Requests\AlbertHeijn\TaxonomyNameSearchRequest;
use Illuminate\Contracts\Bus\Dispatcher as BusDispatcher;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AlbertHeijnScrapeController extends Controller
{
    public function nameSearch(TaxonomyNameSearchRequest $request, EventDispatcher $eventDispatcher): JsonResponse
    {
        $event = new TaxonomyNameSearchEvent(
            name: $request->input('name'),
        );

        $result = $eventDispatcher->dispatch($event, halt: true);

        return response()->json($result);
    }

    public function taxonomySlugSearch(ProductSlugSearchRequest $request, EventDispatcher $eventDispatcher, BusDispatcher $busDispatcher): Response
    {
        $event = new ProductSlugSearchEvent(
            taxonomySlug: $request->input('taxonomySlug'),
        );

        $command = new UpdateTaxonomyFetchedCommand(
            slugifiedName: $request->input('taxonomySlug')
        );

        $busDispatcher->dispatch($command);
        $eventDispatcher->dispatch($event);

        return new Response(null);
    }
}
