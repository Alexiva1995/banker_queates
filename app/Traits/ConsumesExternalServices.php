<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalServices {
    /**
     * Send a request to any service 
     * @return string
     */    
    public function makeRequest($method, $requestUrl, $queryPharams = [], $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => config('services.min_api.base_uri')
        ]);

        if(method_exists($this, 'resolveAuthorization'))
        {
            $this->resolveAuthorization($queryPharams, $formParams, $headers);
        }

        $response = $client->request($method, $requestUrl, [
            'query' => $queryPharams,
            'form_params' => $formParams,
            'headers' => $headers
        ]);
        $response = $response->getBody()->getContents();
        if(method_exists($this, 'decodeResponse'))
        {
            $response = $this->decodeResponse($response);
        }

        if(method_exists($this, 'validateCoinAttributes'))
        {
            $response = $this->validateCoinAttributes($response);
        }

        return $response;
    }
}