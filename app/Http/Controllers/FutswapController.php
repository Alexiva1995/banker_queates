<?php

namespace App\Http\Controllers;

use App\Services\FutswapService;
use App\Services\BonusService;
use App\Models\FutswapTransactions;
use App\Models\OrdenPurchase;
use App\Models\Liquidation;
use App\Models\Wallet;
use App\Models\Member;
use App\Models\AlertNotification;
use App\Models\PoolGlobal;
use App\Models\WithdrawalErrors;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use stdClass;
use Illuminate\Support\Facades\Mail;
use App\Models\Level;

class FutswapController extends Controller
{

    public function __construct(FutswapService $futswapService = null)
    {
        $this->futswap = $futswapService;
    }

    public function paymentConfirmation(Request $request) 
    {
        $data = $request->all();
        $this->validate($request, [ 
            'billId' =>  'required|string|exists:futswap_transactions',
            'secret' => 'required|string|exists:futswap_transactions',
            'externalTxId' => 'required|string|exists:futswap_transactions,orden_purchase_id',
        ]);
        
        $transaction = FutswapTransactions::where('billId', $data['billId'])->first();
        if ($transaction->status == 'PAID') {
            return response()->json(['error' => 'This payment has already been confirmed'], 400);
        }

        $transaction->status = $data['status'];
        $transaction->hash = $data['hash'];
        $transaction->update();
        $transaction->orderPurchase->status = "1";
        $transaction->orderPurchase->save();
        if ($transaction->orderPurchase->type == 'anual') {

            $transaction->orderPurchase->user->date_activo = now();
            $transaction->orderPurchase->user->status = '1';
            $transaction->orderPurchase->user->save();

        }else{
            $memberShips = Member::where([['referred_id',  $transaction->orderPurchase->user_id], ["status", "activo"]])->with("ordenes")->get();
            AlertNotification::create([
                'orden_purchase_id' => $transaction->orderPurchase->id,
                'status' => '1'
            ]);
            if ($memberShips != null){
                foreach ($memberShips as $memberShip) {
                    if ($memberShip->ordenes->membershipPackage->membership_types_id  == $transaction->orderPurchase->membershipPackage->membership_types_id ) {
                        $memberShip->status = "inactivo";
                        $memberShip->update();
                    }
                }
            }
            $pool_global_id = PoolGlobal::where('active', 'yes')->value('id');
            $membership = Member::create([
                'referred_id' => $transaction->orderPurchase->user->id,
                'orden_purchase_id' => $transaction->orderPurchase->id,
                'pool_global_id' => $pool_global_id,
                'status' => 'activo',
            ]);
            //_
            /* Obtiene los puntos a aplicar los cuales son los mismos a la cantidad del paquete comprado */
            $points = intval($membership->ordenes->membershipPackage->amount_per_month);
            $this->callBuildingBonus($transaction, $points, $pool_global_id);
            $this->sumAmountToPoolGlobal($transaction);
            
        }
        return response()->json(['message' => 'Confirmation succesfully'], 201);

    }

    public function withdrawalConfirmation(Request $request)
    {
        $this->validate($request, [ 
            'processId' =>  'required|string|exists:liquidactions',
        ]);
        foreach ($request->to as $to) {
            $liquidaction = Liquidation::where([['secret', $to['secret']],['processId', $request->processId]])->first();
            if  ($liquidaction != null){
                $liquidaction->status = 1;
                $liquidaction->hash = $to['hash'];
                $liquidaction->update();
                $wallets = Wallet::where('liquidation_id', $liquidaction->id)->get();
                foreach ($wallets as $wallet) {
                    $wallet->status = 1;
                    $wallet->liquidado = 1;
                    $wallet->update();
                }
                $dataEmail = [
                    'name' => $liquidaction->getUserLiquidation->name,
                    'amount' =>$liquidaction->total,
                    'logo' => public_path('/images') . '/login/connect.png'
                ];
                Mail::send('mails.withdrawConfirmation', $dataEmail,  function ($msj) use ($liquidaction) {
                $msj->subject('Withdrawal Confirmed');
                $msj->to($liquidaction->getUserLiquidation->email);
                $msj->cc('retirosconnect@gmail.com');
                });
            }               //enviar correo del retiro succeess $liquidation->total   //enviar correo del retiro canceled $liquidation->total */
        }
        if ($request->errors != null) {
            foreach ($request->errors as $error) {
                $liquidactionFail = Liquidation::where([['secret', $error['secret']],['processId', $request->processId]])->first();
                if ($liquidactionFail != null){
                    $liquidactionFail->status = 2;
                    $liquidactionFail->update();
                    $wallets = Wallet::where('liquidation_id', $liquidactionFail->id)->get();
                    WithdrawalErrors::create([
                        'user_id' => $error['userId'],
                        'processId' => $request['processId'],
                        'name' => $error['userName'],
                        'wallet' => Crypt::encryptString($error['address']),
                        'value' => $error['value'],
                        'secret' => $error['secret'],
                        'error_code' => $error['errorCode'],
                        'error_message' => $error['errorMessage']
                    ]);
                    foreach ($wallets as $wallet) {
                        $wallet->status = 0;
                        $wallet->liquidado = 0;
                        $wallet->liquidation_id = null;
                        $wallet->update();
                    }
                }    
            }
        }
        return response()->json(['message' => 'Confirmation succesfully'], 201);
        
        
    }

    //Llama a bonusService y aplica el building bonus
    private function callBuildingBonus($transaction, $points, $pool_global_id)
    {
        // Usuario que compro el paquete
        $levelActive = Level::where('status', 1)->orderBy('id', 'desc')->first();
        $buyer_id = $transaction->orderPurchase->user_id;
        $level = 1;
        $user = $transaction->orderPurchase->user;
        $amount = $transaction->orderPurchase->amount;
        
        app(BonusService::class)->BuildingBonus($user, $amount, $level, $points, $buyer_id, $pool_global_id, $levelActive);
    }
    //Suma los montos correspondientes al pool global actual
    private function sumAmountToPoolGlobal($transaction)
    {
        $pool_global = PoolGlobal::where('active', 'yes')->first();
        $pool_global->total += $transaction->orderPurchase->amount;
        $pool_global->amount += $transaction->orderPurchase->amount * 0.06;
        $pool_global->update();
    }
    public function scanQr($token)
    {
       
        $transaction = FutswapTransactions::where('token', $token)->first();
       
        $pageConfigs = ['blankPage' => true];
        return view('/futswap/scanQR', compact('transaction'), [
           'pageConfigs' => $pageConfigs
        ]);
    }

    public function redirect()
    {    
        $user = Auth::user();

        $orden = OrdenPurchase::where([['user_id', $user->id],['status', '0'],['type', 'anual']])->count();
       
        if($orden > 0){
            $orden = OrdenPurchase::where([['user_id', $user->id],['status', '0'],['type', 'anual']])->first();
            if($orden->hash == null && $orden->status == 0){
             return $this->redirectCancel();
           
            }else{
                $token = FutswapTransactions::where('orden_purchase_id', $orden->id)->first('token');
                $token = $token['token'];
                return $this->scanQr($token);
            }
        }else{
            return $this->redirectCancel();
        }
       
    }

    public function redirectCancel()
    {    
        $user = Auth::user();

        $orden = new OrdenPurchase();
        $orden->user_id = $user->id;
        $orden->amount = '50';
        $orden->hash = null;
        $orden->status = '0';
        $orden->type = 'anual';
        $orden->save();
        

        $response = $this->futswap->createOrden($user, intval($orden->amount), $orden->id);
      
        if($response[0] != 'error')
        {   
                //redirecciona a la url del pago
            return redirect()->route('scanQr', $response);
        }else{
                return back()->with('error', $response[1] );
            }
      
    }

    public function statusPayment(Request $request)
    {
        $transaction = FutswapTransactions::where('token', $request->token)->first();
        return json_encode($transaction);
    }
}
