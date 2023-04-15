<?php

namespace App\Http\Controllers;

use App\Events\AlbertHeijn\ProductSlugSearchEvent;
use App\Events\AlbertHeijn\TaxonomyNameSearchEvent;
use App\Http\Requests\AlbertHeijn\ProductSlugSearchRequest;
use App\Http\Requests\AlbertHeijn\TaxonomyNameSearchRequest;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AlbertHeijnScrapeController extends Controller
{
    public function nameSearch(TaxonomyNameSearchRequest $request, Dispatcher $dispatcher): JsonResponse
    {
        $event = new TaxonomyNameSearchEvent(
            name: $request->input('name', 'bier'),
        );

        $result = $dispatcher->dispatch($event, halt: true);

        return response()->json($result);
    }

    public function taxonomySlugSearch(ProductSlugSearchRequest $request, Dispatcher $dispatcher): Response
    {
        $event = new ProductSlugSearchEvent(
            taxonomySlug: $request->input('taxonomySlug', 'bier'),
            size: $request->input('size', 5)
        );

        $dispatcher->dispatch($event);

        return new Response(null);
    }
}
