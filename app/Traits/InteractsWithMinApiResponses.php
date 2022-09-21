<?php

namespace App\Traits;

use PhpParser\Node\Stmt\TryCatch;

trait InteractsWithMinApiResponses {
    /**
     * Decode correspondingly the response
     * @param array $response
     * @return stdClass
     */
    public function decodeResponse($response)
    {
        $decodeResponse = json_decode($response);

        return $decodeResponse->Data ?? $decodeResponse;
    }
    /**
     * Resolve if the request to the service failed
     * @param array $response
     * @return void
     */
    public function validateCoinAttributes($response)
    {
        try {
            $cryptos = $response->object()->Data;
        } catch (\Throwable $th) {
            $cryptos = $response;
        }
        
        foreach ($cryptos as $key => $crypto) {
            // dd($crypto->CoinInfo);
            if (!isset($crypto->CoinInfo->Name) || !isset($crypto->CoinInfo->FullName) || !isset($crypto->RAW->USD->LASTUPDATE) || !isset($crypto->DISPLAY->USD->PRICE) || !isset($crypto->DISPLAY->USD->CHANGEPCT24HOUR)) 
            {
                unset($cryptos[$key]);
            }
        }

        return $cryptos;
    }

}