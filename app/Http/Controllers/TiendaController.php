<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\MembershipPackage;
use App\Models\MembershipType;
use App\Http\Traits\Tree;
use Hexters\CoinPayment\CoinPayment;
use App\Http\Controllers\InversionController;
use App\Models\User;
use App\Events\UserEvent;
use App\Http\Requests\PurchaseLicenseStoreRequest;
use App\Models\Investment;
use App\Models\Upgrade;
use App\Services\BonusService;
use App\Services\FutswapService;
use Illuminate\Support\Facades\DB;
use App\Models\Level;
use App\Models\LicensePackage;
use App\Models\walletPayment as WalletPayment;
use App\Services\PointsService;

class TiendaController extends Controller
{
    use Tree;
    protected $pointsService;

    public function __construct(FutswapService $futswapService = null, PointsService $pointsService)
    {
        $this->futswap = $futswapService;
        $this->InversionController = new InversionController;
        $this->pointsService = $pointsService;
    }

    public function marketLicences(Request $request)
    {
        $order = Order::where([['user_id', Auth::id()], ['status', '0']])->first();

        $investments = Investment::where([['user_id', Auth::id()], ['status', '1']])->with('order')->get();
        $licenses = LicensePackage::orderBy('amount', 'ASC')->get();

        foreach ($licenses as $license) {
            $license->disabled = false;
            $license->text = 'Comprar Paquete';
            foreach ($investments as $investment) {
                if ($license->amount <= $investment->invested) {
                    $license->disabled = true;
                    $license->text = 'Adquirido';
                }
                if ($license->amount > $investment->invested) {
                    $license->disabled = false;
                    $license->text = 'Upgrade';
                }
            }
        }
        return view('shop.index', compact('order', 'investments', 'licenses'));
    }

    public function transaction(Request $request)
    {
        $user = Auth::user();
        $investment = Investment::where([['user_id', $user->id], ['status', 1]])->count('id');

        $data = MembershipPackage::where(['membership_types_id' => $request->package])->get();
        $title = MembershipType::where('id', $request->package)->first('name');
        return view('shop.trans', compact('data', 'title'));
    }

    public function transactionCompra(Request $request)
    {
        $user = Auth::user();
        $wallettrc20 = WalletPayment::where('type', 'trc20')->get();
        $walletbnb = WalletPayment::where('type', 'bnb')->get();
        $walletbtc = WalletPayment::where('type', 'btc')->get();
        $inversion = Investment::where([['user_id', $user->id], ['status', 1]])->first();
        if ($inversion != null) {
            $price = $inversion->invested;
            $amount = $request->amount - $inversion->invested;
        } else {
            $amount = $request->amount;
        }

        $packageId = $request->package;
      $total_available = $user->wallets->where('user_id', $user->id)->sum('amount');

        return view('shop.transactionCompra', compact('amount', 'packageId', 'walletbtc','walletbnb','wallettrc20','total_available'));
    }

    /**
     * Procesa el pago o la transacción del usuario al momento de
     * elegir el paquete y enviar su comprobante de pago.
     */
    public function procesarOrden(PurchaseLicenseStoreRequest $request)
    {
        $user = Auth::user();
        $allOrder = Order::where('user_id', $user->id)->where('status', '0')->get();
        $package = LicensePackage::where('id', $request->package)->first();
        $investment = Investment::where('user_id', $user->id)->where('status', 1)->first();
        $orden = new Order();
        // Se cancelan las ordenes previas
        foreach ($allOrder as $order) {
            $order->status = '2';
            $order->save();
        }
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

        if ($orden->save())
        {
            return redirect()->route('dashboard.index')->with('success', 'Orden Creada, procesando su solicitud...');
        }

        return redirect()->back()->with('error', 'Hubo un error, intente nuevamente');
    }

    public function saveOrden($data): int
    {
        $orden = Order::create($data);

        return $orden->id;
    }

    public function typeOrden($id)
    {
        if ($id == 1) {
            return 'Bronce';
        } else if ($id == 2) {
            return 'Plata';
        } else if ($id == 3) {
            return 'Oro';
        } else if ($id == 4) {
            return 'Platino';
        }
    }

    public function cambiar_status(Request $request)
    {

        $orden = Order::findOrFail($request->id);
        $orden->status = $request->status;
        $orden->save();
        $range_points = 0;
        $binary_points = 0;
        // Aqui se cambia el status de una inversion anterior a inactiva si se aprobo un upgrade
        if ($request->status == '1') {

            $investment = Investment::where('user_id', $orden->user->id)->where('status', '1')->first();
            if ($investment != null) {
                
                $range_points = $investment->licensePackage->leadership_points;
                $binary_points = $investment->licensePackage->binary_points;
                //Se crea la inversion al aprobarse la orden
                $investment->order_id = $orden->id;
                $investment->package_id = $orden->package_id;
                $investment->invested = $orden->licensePackage->amount;
                $investment->expiration_date = now()->addYear();
                $investment->save();
                Upgrade::create([
                    'investment_id' => $investment->id,
                    'package_id' => $investment->package_id,
                    'status_utility' => 0
                ]);
                //Se crean los bonos o wallet corresondiente
                // $this->callBuildingBonus($orden);
            } else {
                $inversion = Investment::create([
                    'invested' => $orden->amount,
                    'package_id' => $orden->package_id,
                    'user_id' => $orden->user_id,
                    'order_id' => $orden->id,
                    'status' => '1',
                    'gain'=> 0,
                    'buyer_id' => $orden->user->padre->id,
                    'capital' => 0,
                    'pay_utility' => 0,
                    'expiration_date' => now()->addYear()
                ]);
                Upgrade::create([
                    'investment_id' => $inversion->id,
                    'package_id' => $inversion->package_id,
                    'status_utility' => 1
                ]);
                $user = User::findOrFail($orden->user_id);
                //Se crea la wallet corresondiente
                // $this->callBuildingBonus($orden);

            }
            // Se cambia el status del usuario a activo
            if ($orden->user->status == '0') {
                $orden->user->status = '1';
                $orden->user->date_active = now();
                $orden->user->update();
                event(new UserEvent($user));
            }

            // Genera los puntos binarios
            // Genera los puntos por compra de licencias en linea multinivel
            // Si es un upgrade la cantidad a generar es la de la nueva licencia - la anterior
            if ($investment != null) {
                $range_points = $orden->licensePackage->leadership_points - $range_points;
                $binary_points = $orden->licensePackage->binary_points - $binary_points;

                $this->pointsService->assignPointsRangeRecursively($orden->user, $range_points, $orden);
                
                app(BonusService::class)->assignPointsbinarioRecursively($orden->user, $binary_points, $orden->id);

            } else {

                app(BonusService::class)->assignPointsbinarioRecursively($orden->user, $orden->licensePackage->binary_points, $orden->id);
                
                $this->pointsService->assignPointsRangeRecursively($orden->user, $orden->licensePackage->leadership_points, $orden);
            }

        }

        return back()->with('success', 'Orden actualizada exitosamente');

    }

    // private function callBuildingBonus($orden)
    // {
    //     // Usuario que compro el paquete
    //     $levelActive = Level::where('status', 1)->orderBy('id', 'desc')->first();
    //     $buyer_id = $orden->user_id;
    //     $level = 1;
    //     $user = $orden->user;
    //     $amount = $orden->amount;

    //     app(BonusService::class)->BuildingBonus($user, $amount, $level, $buyer_id, $levelActive, $orden);
    // }

    /**
     * Permite llamar al funcion que registra los contrato
     *
     * @param integer $idorden
     * @return void
     */
    private function registeContract($orden)
    {
        $this->InversionController->saveInversion($orden);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'orden' => 'required',
            'hash' => 'required',
            'comprobante' => 'required|mimes:jpg,jpeg,png',
            'type_payment' => 'required'
        ]);
        try {
            if($validate){
                $orden = OrdenPurchase::find($request->orden);
                $orden->hash = $request->hash;
                $orden->status = '1';
                $orden->type_payment = $request->type_payment;
                if ($request->hasFile('comprobante')) {
                    $user = Auth::user();
                    $file = $request->file('comprobante');
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('storage') .'/'. $user->id.'/comprobante', $name);
                    $orden->comprobante = $name;
                }
                $orden->save();
                return redirect('/')->with('success', 'orden actualizada exitosamente');
            }
        } catch (\Throwable $th) {
            Log::error('TiendaController - store -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function reactivacionSaldo(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            //Cámbialo por el día de la bbdd
            $dia_inicio =  $user->date_activo;
            $data_ex =  date('y-m-d', strtotime($dia_inicio . ' + 30 days'));
            $inversiones = $user->inversiones->where('status', 1);
            $monto = 0;
            foreach ($inversiones as $inversion) {
                $monto += $inversion->invested;
            }

            $pagar = $this->montoReactivacion($monto);

            if ($user->saldoDisponible() >= $pagar) {
                $wallets = $user->getWallet->where('status', 0)->where('tipo_transaction', 0);
                foreach ($wallets as $wallet) {

                    while ($pagar > 0) {

                        $resta = $wallet->amount_fondo - $pagar;

                        if ($resta < 0) {
                            $wallet->amount_fondo = 0;
                            $wallet->status = 1;
                            $wallet->save();
                            $pagar = $resta * (-1);
                        } elseif ($resta == 0) {
                            $wallet->amount_fondo = $resta;
                            $wallet->status = 1;
                            $wallet->save();
                            $pagar = $resta;
                        } else {
                            $wallet->amount_fondo = $resta;
                            $wallet->save();
                            $pagar = 0;
                        }
                    }
                }

                DB::commit();

                return back()->with('succes', 'Reactivacion exitosa');
            } else {
                $this->reactivacion($request);
                //return redirect()->back()->with('info', 'Problemas al generar la orden, no posee saldo suficiente');
            }
        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('Tienda - reactivacion -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function reactivacion(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();

            $inversiones = $user->inversiones->where('status', 1);
            $monto = 0;
            foreach ($inversiones as $inversion) {
                $monto += $inversion->invested;
            }

            $pagar = $this->montoReactivacion($monto);

            // if($user->ganancias() >= $monto){
            //     $inversiones = $user->inversiones->where('status', 1);
            //     $resta = $monto;
            //     foreach($inversiones as $inversion){
            //         $resta = $inversion->gain - $resta;
            //         if($resta < 0){
            //             $inversion->gain = 0;
            //             $resta = $resta * (-1);
            //         }else{
            //             $inversion->gain = $resta;
            //             $resta = 0;
            //         }
            //         $inversion->save();

            //         if($resta == 0){
            //             break;
            //         }
            //     }

            //     DB::commit();

            //     return back()->with('succes', 'Reactivacion exitosa');
            // }else{
            $fee = 0;
            $data = [
                'user_id' => $user->id,
                'amount' => $pagar,
                'fee' => $fee,
                'type' => 'reactivacion'
            ];

            $data['idorden'] = $this->saveOrden($data);
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['total'] = $data['amount'] + $fee;
            $data['descripcion'] = "Reactivacion";

            $url = $this->generalUrlOrden($data);

            if (!empty($url)) {
                DB::commit();
                return redirect($url);
            } else {
                OrdenPurchase::where('id', $data['idorden'])->delete();
                return redirect()->back()->with('info', 'Problemas al general la orden, intente mas tarde');
            }
            // }

        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('Tienda - reactivacion -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function montoReactivacion($monto)
    {
        switch ($monto) {
            case $monto >= 500 && $monto <= 5000:
                $pagar = 12;
                break;
            case $monto >= 5001 && $monto <= 15000:
                $pagar = 20;
                break;
            case $monto >= 15001 && $monto <= 30000:
                $pagar = 35;
                break;
            case $monto >= 30001 && $monto <= 50000:
                $pagar = 50;
                break;
            case $monto >= 50001 && $monto <= 150000:
                $pagar = 80;
                break;
            case $monto >= 150001 && $monto <= 300000:
                $pagar = 1000;
                break;

            default:
                $pagar = 0;
                break;
        }

        return $pagar;
    }

    public function getStatus()
    {
        $transacciones = CoinPayment::gettransactions()->select('txn_id', 'order_id')->get()->toArray();
        foreach ($transacciones as $transaccion) {
            $estado = CoinPayment::getstatusbytxnid($transaccion['txn_id']);

            $status = $estado['status'];
            if ($estado['status'] !== 0) {
                $this->change_status($transaccion['order_id'], $status);
            }
        }
    }

    public function change_status($id, $status)
    {
        try {

            DB::beginTransaction();

            $orden = OrdenPurchase::findOrFail($id);

            if ($orden->status == '0') {

                if ($status < 0) {
                    $orden->status = "2";
                    $orden->save();
                } elseif ($status > 0) {
                    $user = User::findOrFail($orden->user_id);
                    if ($orden->type == 'reactivacion') {
                        $inversion = $user->inversionMasAlta();
                        $parents = $this->getDataFather($user, 2);
                        $parentDirecto = $this->getDataFather($user, 1);
                        if (isset($parentDirecto[0])) {
                            if ($parentDirecto[0]->nivel == 1) {
                                $level = 1;
                                $this->InversionController->bonoRecompra($inversion->id, $parentDirecto, $inversion->invested, $level, $user);
                            } else {
                                $this->InversionController->bonoRecompra($inversion->id, $parentDirecto, $inversion->invested, null, $user);
                            }
                        }
                    } else {
                        $this->registeContract($orden);
                    }

                    $orden->status = "1";
                    $orden->save();

                    $user->status = '1';
                    $user->save();
                }
            }


            DB::commit();
        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('Tienda - change_status -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

}
