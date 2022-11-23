<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\LicensePackage;
use App\Models\Order;
use App\Services\PaymentProcessorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PaymentController extends Controller
{
    public function makePurchase(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'package' => 'required'
        ]);

        $user = Auth::user();
        $allOrder = Order::where('user_id', $user->id)->where('status', '0')->get();
        $package = LicensePackage::where('id', $request->package)->first();
        $investment = Investment::where('user_id', $user->id)->where('status', 1)->first();
        $orden = new Order();

        try {
            if ($investment == null) {
            
                $orden->user_id = $user->id;
                $orden->package_id = $package->id;
                $orden->amount = $package->amount;
                $orden->hash = $request->hash;
    
                $orden->fee = 15;
                $orden->status = '0';
                $orden->type = '0';
                
            } else {
                
                $newAmount = $package->amount - $investment->invested;
                
                $orden->user_id = $user->id;
                $orden->package_id = $package->id;
                $orden->amount = $newAmount;
                $orden->hash = $request->hash;
    
                $orden->fee = 15;
                $orden->status = '0';
                $orden->type = '0';
            }
            
            $payment_platform = resolve(PaymentProcessorService::class);
            // return $qr = QrCode::size(400)->generate(base64_encode('mi_wallet'));

            // return vew('prueba', compact($qr));
            $response = $payment_platform->createOrder($orden->id, $request->amount);
            return $response;

            // Si va todo bien guardamos la orden creada y se colocan todas las ordenes anteriores a status 2
            $orden->hash = $response->id;
            $orden->save(); 
            // Como manejaremos las ordenes anteriores? Se cancelaran, o se esperara a que la pasarela nos envie una peticion
            // para cambiarles el status
            // foreach ($allOrder as $order) {
            //     if ($order->licensePackage->id == $package->id) {
            //         $order->status = '2';
            //         $order->save();
            //     }
            // }

        } catch (\Throwable $th) {
            dd($th);
            Log::info('Fallo al crear orden de pago con la pasarela');
            Log::error($th);
            return back()->with('error', 'No se puede procesar su solicitud por favor contacte con el administrador');
        }
        
    }

    public function paymentConfirmation(Request $request)
    {
        // $request->validate([
        //     // te valido :D
        // ]);

        $response = [];

        return 'holi';
        if( $request->secret_key != $this->secret_key ) {
            $response['error'] = [
                'message' => 'the secret key is wrong',
                'type' => 'auth',
            ];
            return response()->json($response, 401);
        }
    }
}
