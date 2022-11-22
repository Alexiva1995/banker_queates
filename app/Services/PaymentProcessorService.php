<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;
use Http;

/**
 * Class PaymentProcessorService.
 */
class PaymentProcessorService
{
    use ConsumesExternalServices;

    /**
     * The url from wich send the requests
     * @var string
    */
    protected $baseUri;

    /**
     * The Access token 
     * @var string
    */
    protected $x_token;

    public function __construct()
    {
        $this->baseUri = config('services.payment_processor.base_uri');
        $this->x_token = config('services.payment_processor.x-token');
    }
    
    public function resolveAuthorization(&$queryPharams, &$formParams, &$headers)
    {
        $headers['x-token'] = $this->x_token;
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    /**
     * Builds the structure for the request to the payment gateway to create a new payment
     * @param Int $amount the amount for which the payment order is to be created
     * @param String $currency Transaction currency or currency type (Example: USDT, ETH, BTC)
     * @param String $network The network that will process the transaction (Example: TRX, BEP20, ETH)
     * @var string
    */
    public function createOrder($amount, $currency, $network)
    {
        $request_body = [
            'crypto' => $currency,
            'network' => $network,
            'amount' => $amount,
            'toAddress' => 'TN2U4pbJuCJZaYzDfj2RVRAZSbuPtRfTDV',
            'wallet' => '0x8Ab8C2810a7d486486293b04cdF886f41B5B58DC'
        ];

        return $this->makeRequest(
            $method = 'POST',
            $url = '/transactions/send',
            $queryPharams = [],
            $body = [ ['body' => json_encode($request_body)] ],
            $headers = [],
            $isJsonRequest = true,
        );
    }

    public function getOrderDetails()
    {
        $response = $response = Http::withHeaders([
                'x-token' => $this->x_token
            ])->get("{$this->baseUri}transactions/0x8Ab8C2810a7d486486293b04cdF886f41B5B58DC");

        return $response->json();
    }
}
