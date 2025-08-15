<?php

namespace App\Services\Monobank;

use App\Exceptions\MonobankApiException;
use Illuminate\Support\Facades\Http;

class MonobankApiService
{
    public function fetch(string $uri): array
    {
        $data = Http::get(config('monobank.api_url') . $uri);

        if($data->ok()){
            return $data->json();
        }

        throw new MonobankApiException($data->json('errText'));
    }
}
