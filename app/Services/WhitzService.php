<?php

namespace App\Services;

use Http;
use App\Models\OrdenPurchase;
use App\Models\FutswapTransactions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FutswapService
{
    private $futswap;

    const  COINSYMBOL = "USDT";
    const  NETWORK = "TRON";

    public function __construct(FutswapTransactions $futswap = null)
    {
        $this->futswap = $futswap;
    }


    public function createUserBalance($user)
    {
        $url = config('whitz.apiUrl');
       // $token = $this->generateKey();
       $response = Http::withHeaders([
            'x-api-key' => config('whitz.apiKey'),
            'auth' => config('whitz.apiToken')
        ])->post("{$url}", [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'address' => 'cambiar',
            'email' => $user->email,
            'country_id' => $user->countrie_id,
            'phonenumber' => $user->phone,
            'type' => '1'
        ]);
        if($response->successful())
        {
            $json = $response->json();
            $json['data']['orden_purchase_id'] = $ordenId;

            $futswap_transaction = $this->futswap->storeFutswapTransaction($json['data']);
            return $this->updateHash($futswap_transaction, $ordenId);

        }else{

            Log::info('Error Whitz- '.$response);
            $order = OrdenPurchase::where('id', $ordenId)->first();
            $order->status = '2';
            $order->update();
            $error = ['error'];
            $error[] = $response->json()['message'];
            return $error;
        }
    }
    public function show()
    {
        $url = config('whitz.apiUrl');
        $response = Http::withHeaders([
            'x-api-key' => config('whitz.apiKey'),
        ])->get("{$url}/bill/status", [
            'id'=> 152,
            'customer_id'=> 1,
            'filename'=> "example.png",
            'type'=> "image\/png",
            'size'=> 3517,
            'created'=> "2016-08-19",
            'purpose_id'=> 1,
            'description'=> "",
            'uploaded_by_id'=> null,
            'download_url'=> "https:\/\/example.com\/customer\/profile\/download_file\/152",
            'billId' => $billId,
        ]);
        if($response->successful())
        {
            $data = $response->json();
            return $this->updateStatusCanceled($data['data']);

        }else{
            $error = ['error'];
            $error[] = $response->json()['message'];
            return $error;
        }
    }

    public function checkStatusFutswap()
    {
        $transactions = FutswapTransactions::where('status', 'PENDING_PAYMENT')->get();
        foreach ($transactions as $trans) {
            $this->getBillStatus($trans->billId);
        }
    }

    private function getBillStatus($billId) {
        $url = config('futswap.apiUrl');

        $response = Http::withHeaders([
            'x-api-key' => config('futswap.apiKey'),
        ])->get("{$url}/bill/status", [
            'companyId' => config('futswap.companyId'),
            'billId' => $billId,
        ]);
        if($response->successful())
        {
            $data = $response->json();
            return $this->updateStatusCanceled($data['data']);

        }else{
            $error = ['error'];
            $error[] = $response->json()['message'];
            return $error;
        }
    }

    private function updateHash($transaction, $ordenId)
    {
        OrdenPurchase::where(['id' => $ordenId])->update(['hash' => $transaction['billId']]);
        return $transaction->token;
    }

    private function generateKey()
    {
        do {
            $token = Str::uuid();
        } while (FutswapTransactions::where("secret", $token)->first() instanceof FutswapTransactions);

        return $token;
    }

    private function updateStatusCanceled($data)
    {

        if ($data['status'] == 'CANCELED') {
            $transaction = FutswapTransactions::where('billId', $data['billId'])->first();
            $transaction->status = $data['status'];
            $transaction->update();
            $transaction->orderPurchase->status = "2";
            $transaction->orderPurchase->save();
        }
    }

    public function withdrawal($user, $amount, $address) {
       // dd($amount);
        $url = config('futswap.apiUrl');
        $object = new \stdClass();
        $object->userId = strval($user->id);
        $object->username = $user->name;
        $object->secret = $this->generateKey();
        $object->address = $address;
         $object->amount = $amount;

        $response = Http::withHeaders([
            'x-api-key' => config('futswap.apiKey'),
        ])->post("{$url}/wth/massive", [
            'companyId' => config('futswap.companyId'),
            'value' => $amount,
            'coinSymbol' => self::COINSYMBOL,
            'network' => self::NETWORK,
            'data' => [$object]
        ]);

        if($response->successful())
        {
            $data = $response->json();
            $jsonData = $data['data'];
            $jsonData['secret'] = $object->secret;
            $json = [['success'], $jsonData];
            return $json;

        }else{
            Log::info('Error Withdrawal Futswap- '.$response);
            $error = ['error'];
            $error[] = $response->json()['message'];
            return $error;
        }
    }

}
