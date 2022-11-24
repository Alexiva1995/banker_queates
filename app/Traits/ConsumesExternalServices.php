<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalServices {
    /**
     * Send a request to any service 
     * @return string
     */    
    public function makeRequest($method, $requestUrl, $queryPharams = [], $formParams = [], $headers = [], $isJsonRequest = false)
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if(method_exists($this, 'resolveAuthorization'))
        {
            $this->resolveAuthorization($queryPharams, $formParams, $headers);
        }

        $response = $client->request($method, $requestUrl, [
            $isJsonRequest ? 'json' : 'form_params' => $formParams,
            'query' => $queryPharams,
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