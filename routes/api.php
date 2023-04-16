<?php

use App\Http\Controllers\AlbertHeijnScrapeController;
use Illuminate\Routing\Router;

/** @var Router $router */
$router->get('ah/search/taxonomy', [AlbertHeijnScrapeController::class, 'nameSearch']);
$router->post('ah/search/products', [AlbertHeijnScrapeController::class, 'taxonomySlugSearch']);
