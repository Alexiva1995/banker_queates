<?php

namespace App\Services;

use App\Traits\AuthorizesMinApiRequests as TraitsAuthorizesMinApiRequests;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMinApiResponses;

/**
 * Class CryptoApiService.
 */
class MinApiService
{
    use ConsumesExternalServices, TraitsAuthorizesMinApiRequests, InteractsWithMinApiResponses;

    /**
     * The url from wich send the requests
     * @var string
    */

    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.min_api.base_uri');
    }
    /** 
     * Obtains 10 cryptoscurrencies from the API
    */
    public function get10Cryptos()
    {
        return $this->makeRequest(
            'GET', 
            'data/top/totalvolfull', 
            ['tsym' => 'USD','limit'=>'10'],
        );
    }
}
