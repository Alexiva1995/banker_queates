<?php

namespace App\Http\Controllers;

use Coinbase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\MembershipPackage;
use App\Models\MembershipType;
use App\Models\Member;
use App\Models\Bonus;
use App\Models\WalletComission;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\Tree;
use Hexters\CoinPayment\CoinPayment;
use DB;
use App\Http\Controllers\InversionController;
use App\Models\User;
use App\Events\UserEvent;
use App\Models\Investment;
use App\Models\PoolGlobal;
use App\Models\Upgrade;
use App\Models\WalletPayment;
use App\Services\BonusService;
use App\Services\FutswapService;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Database\Console\DbCommand;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;
use App\Models\Level;

class TiendaController extends Controller
{
    //
    use Tree;

    public function __construct(FutswapService $futswapService = null)
    {
        $this->futswap = $futswapService;
        $this->InversionController = new InversionController;
    }

    public function index(Request $request)
    {
        $member = Member::where('referred_id', Auth::id())->orderBy('id', 'DESC')->first();
        $data = MembershipType::with('MembershipPackage')->get();
        $order = OrdenPurchase::where([['user_id', Auth::id()], ['status', '0']])->first();
        $memberships = Member::where([['referred_id', Auth::id()], ['status', 'activo']])->with('ordenes')->get();
        if ($memberships != null) {
            foreach ($data as $type) {
                $type->MembershipPackage = $type->MembershipPackage->sortBy('amount');
            }
            foreach ($data as $type) {
                foreach ($type->MembershipPackage as $package) {
                    $package->disabled = false;
                    $package->text = 'Adquirir';
                    foreach ($memberships as $membership) {
                        if ($package->amount <= $membership->ordenes->membershipPackage->amount) {
                            $package->disabled = true;
                            $package->text = 'No se puede adquirir';
                        }
                        if ($package->id == $membership->ordenes->membershipPackage->id) {
                            $package->text = 'Adquirido';
                        }
                    }
                }
            }
        }
        return view('shop.index', compact('data', 'order', 'memberships', 'member'));
    }
    public function broncePackages(Request $request)
    {
        $order = Order::where([['user_id', Auth::id()], ['status', '0']])->first();

        $memberships = Investment::where([['user_id', Auth::id()], ['status', '1']])->with('order')->get();
        $type = MembershipPackage::where('membership_types_id', '1')->orderBy('amount', 'ASC')->get();

        foreach ($type as $package) {
            $package->disabled = false;
            $package->text = 'Comprar Paquete';
            foreach ($memberships as $membership) {
                // dd($membership);
                if ($package->membership_types_id == $membership->membershipPackage->membership_types_id) {
                    if ($package->amount <= $membership->invested) {
                        $package->disabled = true;
                        $package->text = 'Adquirido';
                    }
                    if ($package->id == $membership->package_id) {
                        $package->text = 'Adquirido';
                        $package->disabled = true;
                    }
                    if ($package->amount > $membership->invested) {
                        $package->disabled = false;
                        $package->text = 'Upgrade';
                    }
                }
            }
        }
        return view('shop.broncePackages', compact('order', 'memberships', 'type'));
    }
    public function plataPackages(Request $request)
    {
        $order = Order::where([['user_id', Auth::id()], ['status', '0']])->first();

        $memberships = Investment::where([['user_id', Auth::id()], ['status', '1']])->with('order')->get();
        $type = MembershipPackage::where('membership_types_id', '2')->orderBy('amount', 'ASC')->get();

        foreach ($type as $package) {
            $package->disabled = false;
            $package->text = 'Comprar Paquete';

            foreach ($memberships as $membership) {
                if ($package->membership_types_id === $membership->membershipPackage->membership_types_id) {
                    // dd($membership->membershipPackage->membership_types_id);
                    if ($package->amount <= $membership->invested) {
                        $package->disabled = true;
                        $package->text = 'Adquirido';
                    } elseif ($package->id == $membership->package_id) {
                        $package->text = 'Adquirido';
                        $package->disabled = true;
                    } else if ($package->amount > $membership->invested) {
                        $package->disabled = false;
                        $package->text = 'Upgrade';
                    }
                }
            }
        }
        return view('shop.plataPackages', compact('order', 'memberships', 'type'));
    }
    public function oroPackages(Request $request)
    {
        $order = Order::where([['user_id', Auth::id()], ['status', '0']])->first();

        $memberships = Investment::where([['user_id', Auth::id()], ['status', '1']])->with('order')->get();
        $type = MembershipPackage::where('membership_types_id', '3')->orderBy('amount', 'ASC')->get();

        foreach ($type as $package) {
            $package->disabled = false;
            $package->text = 'Comprar Paquete';
            foreach ($memberships as $membership) {
                // dd($membership);
                if ($package->membership_types_id == $membership->membershipPackage->membership_types_id) {
                    if ($package->amount <= $membership->invested) {
                        $package->disabled = true;
                        $package->text = 'Adquirido';
                    }
                    if ($package->id == $membership->package_id) {
                        $package->text = 'Adquirido';
                        $package->disabled = true;
                    }
                    if ($package->amount > $membership->invested) {
                        $package->disabled = false;
                        $package->text = 'Upgrade';
                    }
                }
            }
        }
        return view('shop.oroPackages', compact('order', 'memberships', 'type'));
    }
    public function platinoPackages(Request $request)
    {
        // $member = Member::where('referred_id', Auth::id())->orderBy('id', 'DESC')->first();
        // $data = MembershipType::with('MembershipPackage')->get();
        $order = Order::where([['user_id', Auth::id()], ['status', '0']])->first();

        $memberships = Investment::where([['user_id', Auth::id()], ['status', '1']])->with('order')->get();
        $type = MembershipPackage::where('membership_types_id', '4')->orderBy('amount', 'ASC')->get();

        foreach ($type as $package) {
            $package->disabled = false;
            $package->text = 'Comprar Paquete';
            foreach ($memberships as $membership) {
                // dd($membership);
                if ($package->membership_types_id == $membership->membershipPackage->membership_types_id) {
                    if ($package->amount <= $membership->invested) {
                        $package->disabled = true;
                        $package->text = 'Adquirido';
                    }
                    if ($package->id == $membership->package_id) {
                        $package->text = 'Adquirido';
                        $package->disabled = true;
                    }
                    if ($package->amount > $membership->invested) {
                        $package->disabled = false;
                        $package->text = 'Upgrade';
                    }
                }
            }
        }

        return view('shop.platinoPackages', compact('order', 'memberships', 'type'));
    }
    public function transaction(Request $request)
    {
        $user = Auth::user();
        $investment = Investment::where([['user_id', $user->id], ['status', 1]])->count('id');

        $data = MembershipPackage::where(['membership_types_id' => $request->package])->get();
        $title = MembershipType::where('id', $request->package)->first('name');
        return view('shop.trans', compact('data', 'title'));
    }

    public function comprobante(Request $request)
    {
    }

    public function transactionCompra(Request $request)
    {
        $user = Auth::user();
        $wallettrc20 = WalletPayment::where('type', 'trc20')->get();
        $walletbnb = WalletPayment::where('type', 'bnb')->get();
        $walletbtc = WalletPayment::where('type', 'btc')->get();
        $inversion = Investment::where([['user_id', $user->id], ['status', 1], ['type', $request->type]])->first();
        if ($inversion != null) {
            $price = $inversion->invested;
            $amount = $request->amount - $inversion->invested;
        } else {
            $amount = $request->amount;
        }


        if ($request->type == 1) {
            $type = "bronce";
        } elseif ($request->type == 2) {
            $type = "plata";
        } elseif ($request->type == 3) {
            $type = "Oro";
        } elseif ($request->type == 4) {
            $type = "Platino";
        }
        $packageId = $request->package;
        return view('shop.transactionCompra', compact('amount', 'type', 'packageId', 'walletbtc','walletbnb','wallettrc20'));
    }


    public function procesarOrden(Request $request)
    {

        $user = Auth::user();
        // try {
        $orden_pack = Order::where([['user_id', $user->id], ['status', '1']])->count();
        $allOrder = Order::where('user_id', $user->id)->where('status', '0')->get();
        // if($orden_pack > 0) return redirect()->back()->with('error','Usted ya tiene un paquete activo');
        $package = MembershipPackage::where('id', $request->package)->first();
        $investment = Investment::where('user_id', $user->id)->where('type', $package->membership_types_id)->where('status', 1)->first();
        if ($investment == null) {
            foreach ($allOrder as $order) {
                if ($order->membershipPackage->membership_types_id == $package->membership_types_id) {
                    $order->status = '2';
                    $order->save();
                }
            }
            $orden = new Order();
            $orden->user_id = $user->id;
            $orden->package_id = $package->id;
            $orden->amount = $package->amount;
            $orden->hash = $request->hash;

            //guardamos comprobante
            $file = $request->file('voucher');
            $name = time() . "." . $file->extension();
            $file->move(public_path('storage') . '/comprobantes/', $name);
            $orden->voucher = '' . $name;

            $orden->fee = 15;
            $orden->status = '0';
            $orden->type = '0';
            $orden->save();

            if ($orden->id !== null) {
                //momentaneo hasta que se enlace la plataforma de pago
                //  $response = $this->futswap->createOrden($user, intval($data['amount']), $data['idorden']);
                // if($response[0] != 'error')
                // {
                //     //redirecciona a la url del pago
                //     return redirect()->route('scanQr', $response);
                // }else{
                //     return back()->with('error', $response[1] );
                // }
                return redirect()->route('dashboard.index')->with('success', 'Orden Creada, procesando su solicitud...');
            } else {
                return redirect()->back()->with('error', 'Hubo un error, intente nuevamente');
            }
        } else {
            $newAmount = $package->amount - $investment->invested;
            foreach ($allOrder as $order) {
                if ($order->membershipPackage->membership_types_id == $package->membership_types_id) {
                    $order->status = '2';
                    $order->save();
                }
            }
            $orden = new Order();
            $orden->user_id = $user->id;
            $orden->package_id = $package->id;
            $orden->amount = $newAmount;
            $orden->hash = $request->hash;

            //guardamos comprobante
            $file = $request->file('voucher');
            $name = time() . "." . $file->extension();
            $file->move(public_path('storage') . '/comprobantes/', $name);
            $orden->voucher = '' . $name;

            $orden->fee = 15;
            $orden->status = '0';
            $orden->type = '0';
            $orden->save();




            if ($orden->id !== null) {
                //momentaneo hasta que se enlace la plataforma de pago
                return redirect()->route('dashboard.index')->with('success', 'Orden Creada, procesando su solicitud...');
            } else {
                return redirect()->back()->with('error', 'Hubo un error, intente nuevamente');
            }
        }

        // } catch (\Throwable $th) {
        //   Log::error('Tienda - procesarOrden -> Error: ' . $th);
        //   abort(403, "Ocurrio un error, contacte con el administrador");
        //}
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

    private function generalUrlOrden($data): string
    {
        try {
            $charge = Coinbase::createCharge([
                'name' =>  $data['name'],
                'description' => $data['descripcion'],
                'local_price' => [
                    'amount' =>  $data['total'],
                    'currency' => 'USD',
                ],
                'pricing_type' => 'fixed_price'

            ]);
            return $charge['data']['hosted_url'];
            /* $transaction['order_id'] = $data['idorden']; // invoice number
            $transaction['amountTotal'] = floatval($data['total']);
            $transaction['note'] = $data['descripcion'];
            $transaction['buyer_name'] = $data['name'];
            $transaction['buyer_email'] = $data['email'];
            $transaction['redirect_url'] = route('dashboard.index'); // When Transaction was comleted
            $transaction['cancel_url'] = route('shop'); // When user click cancel link
            $transaction['items'][] = [
                'itemDescription' => 'Inversion',
                'itemPrice' => (float) $data['total'], // USD
                'itemQty' => (int) 1,
                'itemSubtotalAmount' => (float) $data['total'] // USD
            ];

            $ruta = CoinPayment::generatelink($transaction);
            if ($ruta != null) {
                return $ruta;
            } */
        } catch (\Throwable $th) {
            Log::error('Tienda - generalUrlOrden -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function cambiar_status(Request $request)
    {

        // try {
        FacadesDB::beginTransaction();
        $bons = Bonus::where('level', 1)->get();
        $level1 = $bons[0];
        $orden = Order::findOrFail($request->id);
        $user = $orden->user;
        $orden->status = $request->status;
        $orden->save();
        // Aqui se cambia el status de una inversion anterior a inactiva si se aprovo un upgrade
        if ($request->status == '1') {
            $investment = Investment::where('user_id', $user->id)->where('status', '1')->where('type', $orden->membershipPackage->membership_types_id)->first();
            if ($investment != null) {
                //Se crea la inversion al aprobarse la orden
                $investment->order_id = $orden->id;
                $investment->package_id = $orden->package_id;
                $investment->invested = $orden->membershipPackage->amount;
                $investment->save();
                Upgrade::create([
                    'investment_id' => $investment->id,
                    'package_id' => $investment->package_id,
                    'status_utility' => 0
                ]);
                //Se crea la wallet corresondiente
                $this->callBuildingBonus($orden);
            } else {
                $inversion = Investment::create([
                    'invested' => $orden->amount,
                    'package_id' => $orden->package_id,
                    'type' => $orden->membershipPackage->membership_types_id,
                    'user_id' => $orden->user_id,
                    'order_id' => $orden->id,
                    'status' => '1',
                    'gain'=> 0,
                    'buyer_id' => $orden->user->padre->id,
                    'capital' => 0,
                    'pay_utility' => 0,
                ]);
                Upgrade::create([
                    'investment_id' => $inversion->id,
                    'package_id' => $inversion->package_id,
                    'status_utility' => 1
                ]);
                $user = User::findOrFail($orden->user_id);
                //Se crea la wallet corresondiente
                $this->callBuildingBonus($orden);
                if ($user->status == '0') {
                    $user->status = '1';
                    $user->date_active = Carbon::now();
                    $user->update();
                event(new UserEvent($user));
                }
            }
        }



        FacadesDB::commit();

        return back()->with('success', 'Orden actualizada exitosamente');
        // } catch (\Throwable $th) {

        //    FacadesDB::rollback();
        //    Log::error('Tienda - cambiar_status -> Error: ' . $th);
        //   abort(403, "Ocurrio un error, contacte con el administrador");
        // }

    }
    private function callBuildingBonus($orden)
    {
        // Usuario que compro el paquete
        $levelActive = Level::where('status', 1)->orderBy('id', 'desc')->first();
        $buyer_id = $orden->user_id;
        $level = 1;
        $user = $orden->user;
        $amount = $orden->amount;

        app(BonusService::class)->BuildingBonus($user, $amount, $level, $buyer_id, $levelActive, $orden);
    }

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


    /*
    public function proccess(Request $request)
    {
        try {
            $user = Auth::user();
            $package = Package::findOrFail($request->idproduct);
            $orden = OrdenPurchase::create([
                'user_id' => $user->id,
                'amount' => $package->price,
                'fee' => 0,
                'package_id' => $package->id
            ]);
            return view('shop.transaction', compact('user', 'orden'));
        } catch (\Throwable $th) {
            Log::error('TiendaController - proccess -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
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
    */
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

    public function payRangeBonus()
    {
        app(BonusService::class)->RangeBonus();
        //Cierra el Pool global actual e inicia uno nuevo
        $current_pool_global = PoolGlobal::where('active', 'yes')->first();
        $current_pool_global->active = 'no';
        $current_pool_global->update();
        PoolGlobal::create([
            'total' => 0,
            'amount' => 0,
            'cycle_id' => $current_pool_global->cycle_id + 1,
            'active' => 'yes'
        ]);
        return back()->with('success', 'Bonos por Rangos Pagados Exitosamente');
    }
    /* public function verificationCode(Request $request){

        $data =[
            'clase' => $request->clase,
            'name' => $request->name,
            'monto' => $request->data_monto,
            'activacion_manual' => $request->activacion_manual,
            'montoo' => $request->montoo,
            'wallet' => $request->wallet,
            'email' => $request->email,
            'total' => $request->total,
            'validation_code' => Str::random(10),
        ];



        return view('shop.trans', compact('data'));
    } */
}
