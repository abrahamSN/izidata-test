<?php

namespace App\Repositories;

use App\Interfaces\QuoteRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Cache;

class QuoteRepository implements QuoteRepositoryInterface
{
    public function getQuote()
    {
        $res = Cache::remember('quote', '300', function () {
            $res = Http::pool(fn (Pool $pool) => ([
                $pool->get("https://api.chucknorris.io/jokes/random"),
                $pool->get("https://catfact.ninja/fact")
            ]));

            $resData = [
                'chuck' => $res[0]->json(),
                'cat' => $res[1]->json(),
            ];

            return $resData;
        });

        return $res;
    }
}
