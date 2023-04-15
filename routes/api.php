<?php

use App\Http\Controllers\AlbertHeijnScrapeController;
use Illuminate\Routing\Router;

/** @var Router $router */
$router->get('ah/search/taxonomy', [AlbertHeijnScrapeController::class, 'nameSearch']);
$router->get('ah/search/product', [AlbertHeijnScrapeController::class, 'taxonomySlugSearch']);
