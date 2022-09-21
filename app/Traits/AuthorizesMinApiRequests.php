<?php

namespace App\Traits;

trait AuthorizesMinApiRequests {
   /**
    * Resolves the elements to send when authorizing the request
    * @param array &$queryParams
    * @param array &$formParams
    * @param array &$headers
    * @return void
    */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $accessToken = $this->resolveAccesToken();

        $headers['Authorization'] = $accessToken;
    }
    
    public function resolveAccesToken()
    {
        return config('services.min_api.authorization');
    }
}