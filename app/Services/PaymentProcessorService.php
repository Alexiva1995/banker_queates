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
     * @var String
    */
    protected $baseUri;

    /**
     * The Access token 
     * @var String
    */
    protected $x_token;
    /**
     * The wallet to send the money
     * @var String
     */
    protected $wallet_to_pay;

    const CURRENCY = 'USDT';

    const NETWORK = 'TRX';

    public function __construct()
    {
        $this->baseUri = config('services.payment_processor.base_uri');
        $this->x_token = config('services.payment_processor.x-token');
        $this->wallet_to_pay = config('services.payment_processor.wallet_to_pay');
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
     * @param Int $order_id the id of the order created
     * @param String $currency Transaction currency or currency type (Example: USDT, ETH, BTC)
     * @param String $network The network that will process the transaction (Example: TRX, BEP20, ETH)
     * @var string
    */
    public function createOrder($order_id, $amount)
    {
        $request_body = [
            'crypto' => SELF::CURRENCY,
            'external_id' => $order_id,
            'network' => SELF::NETWORK,
            'amount' => $amount,
            // TODO: Eliminar el envio de wallet a futuro
            'toAddress' => $this->wallet_to_pay,
            // TODO: Obtener esta wallet dinamicamente
            'wallet' => 'TKVMvt54AqMbrFmeUTpxgbCeenst8YHTrN'
        ];

        return $this->makeRequest(
            $method = 'POST',
            $url = 'transactions/send',
            $queryPharams = [],
            $body = [ ['body' => json_encode($request_body)] ],
            $headers = ["Content-Type" => "application/json"],
            $isJsonRequest = true,
        );
    }

    public function getOrderDetails()
    {
        $response = $response = Http::withHeaderggs([
                'x-token' => $this->x_token
            ])->get("{$this->baseUri}transactions/0x8Ab8C2810a7d486486293b04cdF886f41B5B58DC");

        return $response->json();
    }
}
