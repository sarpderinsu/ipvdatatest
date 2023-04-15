<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbertHeijn\TaxonomyNameSearchRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Redis;

class AlbertHeijnScrapeController extends Controller
{
    public function nameSearch(Client $guzzle, TaxonomyNameSearchRequest $request)
    {
//        $result = $guzzle->request('GET', 'https://www.ah.nl/zoeken/api/products/search?taxonomySlug=pils&size=1000');
        $result = $guzzle->request('GET', 'https://www.ah.nl/zoeken/api/taxonomy?name=bier');

        $body = $result->getBody();

        $json = json_decode((string) $body);

////        foreach ($json->cards as $card) {
////            dump($card->products[0]);
////        }
//
//        dd($json);

        return response()->json($json);
    }
}
