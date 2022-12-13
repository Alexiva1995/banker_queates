<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Http\Traits\Tree;
use App\Models\Investment;
use App\Models\Rentabilidad;
use App\Models\PorcentajeRentabilidad;
use Illuminate\Support\Carbon;
use App\Models\Log_rentabilidad;
use Illuminate\Support\Facades\Auth;
use App\Models\Liquidation;
use App\Models\WalletComission;
use App\Models\Member;
use App\Models\WalletRentability;
use App\Models\MembershipType;
use Illuminate\Database\Eloquent\Collection;

class InversionController extends Controller
{
    use Tree;

    /**
     * Index para el usuario administrador
     * @return Http\Response
     */
    public function adminIndex()
    {
        $investments = Investment::orderBy('id', 'desc')->with('order')->get();
        return view('inversion.admin-index', compact('investments'));
    }
    /**
     * Index para el usuario
     * @return Http\Response
     */
    public function userIndex()
    {
        $user = Auth::user();
        $investments = Investment::where('user_id', $user->id)->with('licensePackage')->orderBy('id', 'desc')->get();
        return view('inversion.index', compact('investments', 'user'));
    }

    public function myPackages()
    {
        $bronzePackage = null;
        $silverPackage = null;
        $goldPackage = null;
        $platinumPackage = null;
        $investments = Investment::with('utilities')->with('membershipPackage')->where('user_id', Auth::user()->id)->get();
        foreach($investments as $key => $invesment)
        {
            switch ($invesment->membershipPackage->membershipType->name) {
                case 'Bronce':
                    $bronzePackage = $invesment;
                    break;
                case 'Plata':
                    $silverPackage = $invesment;
                    break;
                case 'Oro':
                    $goldPackage = $invesment;
                    break;
                case 'Platino':
                    $platinumPackage = $invesment;
                    break;
            }
        }
        $bronzePackage = $bronzePackage !== null ? $bronzePackage : 0;
        $silverPackage = $silverPackage !== null ? $silverPackage : 0;
        $goldPackage = $goldPackage !== null ? $goldPackage : 0;
        $platinumPackage = $platinumPackage != null ? $platinumPackage : 0;
        return view('inversion.myPackages', compact('bronzePackage','silverPackage','goldPackage','platinumPackage'));
    }
    public function getPackegeType()
    {
        $data = MembershipType::get();

        return view('inversion.index', compact('data'));
    }


    public function payRentability()
    {
        $memberShip = Member::where('status', 'activo')->get();

        foreach ($memberShip as $mem) {

            if ($mem->ordenes->membershipPackage->membership_types_id == '2') {
                $this->payRentPlata($mem);
            } elseif ($mem->ordenes->membershipPackage->membership_types_id == '3') {
                $this->payRentOro($mem);
            } elseif ($mem->ordenes->membershipPackage->membership_types_id == '1') {

                $this->payRentBronce($mem);
            } elseif ($mem->ordenes->membershipPackage->membership_types_id == '4') {

                $this->payRentPlatino($mem);
            }
        }
    }
    public function payRentPlata($mem)
    {

        $wallets = WalletRentability::where('member_id', $mem->id)->get();

        $inversion = Investment::where('orden_purchases_id', $mem->ordenes->id)->first();

        $gain = $inversion->gain;

        if ($wallets->isEmpty()) {
            $percent = $mem->ordenes->membershipPackage->percentage;
            $price = $mem->ordenes->membershipPackage->amount;
            $amount = $price * ($percent / 100);

            $wallet = new WalletRentability();
            $wallet->user_id = $mem->ordenes->user_id;
            $wallet->member_id = $mem->id;
            $wallet->inversion_id = $inversion->id;
            $wallet->amount = $amount;
            $wallet->amount_fond = $amount;
            $wallet->status = 0;
            $wallet->percentage = $percent;
            $wallet->save();

            $inversion->update([
                'gain' => $amount,
                'capital' => $amount,
            ]);
        } else {

            $percent = $mem->ordenes->membershipPackage->percentage;
            $price = $mem->ordenes->membershipPackage->amount;
            $amount = $price * ($percent / 100);

            if ($gain + $amount >= $price * 2) {



                $wallet = new WalletRentability();
                $wallet->user_id = $mem->ordenes->user_id;
                $wallet->member_id = $mem->id;
                $wallet->inversion_id = $inversion->id;
                $wallet->amount = ($gain + $amount) - ($price * 2);
                $wallet->amount_fond = ($gain + $amount) - ($price * 2);
                $wallet->status = 0;
                $wallet->percentage = $percent;
                $wallet->save();

                $inversion->update([
                    'gain' => $gain + ($gain + $amount) - ($price * 2),
                    'capital' => $gain + ($gain + $amount) - ($price * 2),
                    'status' => 2
                ]);


                $mem->update([
                    'status' => 'inactivo',
                ]);
            } else {

                $inversion->update([
                    'gain' => $gain + $amount,
                    'capital' => $gain + $amount,
                ]);


                $wallet = new WalletRentability();
                $wallet->user_id = $mem->ordenes->user_id;
                $wallet->member_id = $mem->id;
                $wallet->inversion_id = $inversion->id;
                $wallet->amount = $amount;
                $wallet->amount_fond = $amount;
                $wallet->status = 0;
                $wallet->percentage = $percent;
                $wallet->save();
            }
        }
    }

    public function payRentBronce($mem)
    {



        $wallets = WalletRentability::where('member_id', $mem->id)->get();
        $inversion = Investment::where('orden_purchases_id', $mem->ordenes->id)->first();
        $gain = $inversion->gain;

        if ($wallets->isEmpty()) {
            $percent = $mem->ordenes->membershipPackage->percentage;
            $price = $mem->ordenes->membershipPackage->amount;
            $amount = $price * ($percent / 100);


            $wallet = new WalletRentability();
            $wallet->user_id = $mem->ordenes->user_id;
            $wallet->member_id = $mem->id;
            $wallet->inversion_id = $inversion->id;
            $wallet->amount = $amount;
            $wallet->amount_fond = $amount;
            $wallet->status = 0;
            $wallet->percentage = $percent;
            $wallet->save();

            $inversion->update([
                'gain' => $amount,
                'capital' => $amount,
            ]);
        } else {

            $percent = $mem->ordenes->membershipPackage->percentage;
            $price = $mem->ordenes->membershipPackage->amount;
            $amount = $price * ($percent / 100);

            if ($gain + $amount >= $price * 2) {


                $wallet = new WalletRentability();
                $wallet->user_id = $mem->ordenes->user_id;
                $wallet->member_id = $mem->id;
                $wallet->inversion_id = $inversion->id;
                $wallet->amount = ($gain + $amount) - ($price * 2);
                $wallet->amount_fond = ($gain + $amount) - ($price * 2);
                $wallet->status = 0;
                $wallet->percentage = $percent;
                $wallet->save();

                $inversion->update([
                    'gain' => $gain + ($gain + $amount) - ($price * 2),
                    'capital' => $gain + ($gain + $amount) - ($price * 2),
                    'status' => 2
                ]);


                $mem->update([
                    'status' => 'inactivo',
                ]);
            } else {


                $wallet = new WalletRentability();
                $wallet->user_id = $mem->ordenes->user_id;
                $wallet->member_id = $mem->id;
                $wallet->inversion_id = $inversion->id;
                $wallet->amount = $amount;
                $wallet->amount_fond = $amount;
                $wallet->status = 0;
                $wallet->percentage = $percent;
                $wallet->save();

                $inversion->update([
                    'gain' => $gain + $amount,
                    'capital' => $gain + $amount,
                ]);
            }
        }
    }

    public function payRentPlatino($mem)
    {



        $wallets = WalletRentability::where('member_id', $mem->id)->get();
        $inversion = Inversion::where('orden_purchases_id', $mem->ordenes->id)->first();
        $gain = $inversion->gain;

        if ($wallets->isEmpty()) {
            $percent = $mem->ordenes->membershipPackage->percentage;
            $price = $mem->ordenes->membershipPackage->amount;
            $amount = $price * ($percent / 100);


            $wallet = new WalletRentability();
            $wallet->user_id = $mem->ordenes->user_id;
            $wallet->member_id = $mem->id;
            $wallet->inversion_id = $inversion->id;
            $wallet->amount = $amount;
            $wallet->amount_fond = $amount;
            $wallet->status = 2;
            $wallet->percentage = $percent;
            $wallet->save();

            $inversion->update([
                'gain' => $amount,
                'capital' => $amount,
            ]);
        } else {

            $percent = $mem->ordenes->membershipPackage->percentage;
            $price = $mem->ordenes->membershipPackage->amount;
            $amount = $price * ($percent / 100);

            if ($gain + $amount >= $price * 2) {


                $wallet = new WalletRentability();
                $wallet->user_id = $mem->ordenes->user_id;
                $wallet->member_id = $mem->id;
                $wallet->inversion_id = $inversion->id;
                $wallet->amount = ($gain + $amount) - ($price * 2);
                $wallet->amount_fond = ($gain + $amount) - ($price * 2);
                $wallet->status = 2;
                $wallet->percentage = $percent;
                $wallet->save();

                $inversion->update([
                    'gain' => $gain + ($gain + $amount) - ($price * 2),
                    'capital' => $gain + ($gain + $amount) - ($price * 2),
                    'status' => 2
                ]);

                $wallets_count = WalletRentability::where('member_id', $mem->id)->where('status', 2)->count();

                if ($wallets_count == 7) {
                    $wallets_2 = WalletRentability::where('member_id', $mem->id)->where('status', 2)->get();

                    foreach ($wallets_2 as $wall_2) {

                        WalletRentability::where(['id' => $wall_2->id])
                            ->update([
                                'status' => 0,
                            ]);
                    }
                }

                $mem->update([
                    'status' => 'inactivo',
                ]);
            } else {




                $wallet = new WalletRentability();
                $wallet->user_id = $mem->ordenes->user_id;
                $wallet->member_id = $mem->id;
                $wallet->inversion_id = $inversion->id;
                $wallet->amount = $amount;
                $wallet->amount_fond = $amount;
                $wallet->status = 2;
                $wallet->percentage = $percent;
                $wallet->save();

                $inversion->update([
                    'gain' => $gain + $amount,
                    'capital' => $gain + $amount,
                ]);

                $wallets_count = WalletRentability::where('member_id', $mem->id)->where('status', 2)->count();

                if ($wallets_count == 7) {

                    $wallets_2 = WalletRentability::where('member_id', $mem->id)->where('status', 2)->get();

                    foreach ($wallets_2 as $wall_2) {

                        WalletRentability::where(['id' => $wall_2->id])
                            ->update([
                                'status' => 0,
                            ]);
                    }
                }
            }
        }
    }

    public function payRentOro($mem)
    {

        $wallets = WalletRentability::where('member_id', $mem->id)->get();
        $inversion = Inversion::where('orden_purchases_id', $mem->ordenes->id)->first();
        $gain = $inversion->gain;

        if ($wallets->isEmpty()) {
            $percent = $mem->ordenes->membershipPackage->percentage;
            $price = $mem->ordenes->membershipPackage->amount;
            $amount = $price * ($percent / 100);

            $wallet = new WalletRentability();
            $wallet->user_id = $mem->ordenes->user_id;
            $wallet->member_id = $mem->id;
            $wallet->inversion_id = $inversion->id;
            $wallet->amount = $amount;
            $wallet->amount_fond = $amount;
            $wallet->status = 2;
            $wallet->percentage = $percent;
            $wallet->save();

            $inversion->update([
                'gain' => $amount,
                'capital' => $amount,
            ]);
        } else {



            $percent = $mem->ordenes->membershipPackage->percentage;
            $price = $mem->ordenes->membershipPackage->amount;
            $amount = $price * ($percent / 100);

            if ($gain + $amount >= $price * 4) {



                $wallet = new WalletRentability();
                $wallet->user_id = $mem->ordenes->user_id;
                $wallet->member_id = $mem->id;
                $wallet->inversion_id = $inversion->id;
                $wallet->amount = ($gain + $amount) - ($price * 4);
                $wallet->amount_fond = ($gain + $amount) - ($price * 4);
                $wallet->status = 2;
                $wallet->percentage = $percent;
                $wallet->save();

                $inversion->update([
                    'gain' => $gain + ($gain + $amount) - ($price * 4),
                    'capital' => $gain + ($gain + $amount) - ($price * 4),
                    'status' => 2
                ]);


                $wallets_2 = WalletRentability::where('member_id', $mem->id)->where('status', 2)->get();

                foreach ($wallets_2 as $wall_2) {

                    WalletRentability::where(['id' => $wall_2->id])
                        ->update([
                            'status' => 0,
                        ]);
                }

                $mem->update([
                    'status' => 'inactivo',
                ]);
            } else {


                $wallet = new WalletRentability();
                $wallet->user_id = $mem->ordenes->user_id;
                $wallet->member_id = $mem->id;
                $wallet->inversion_id = $inversion->id;
                $wallet->amount = $amount;
                $wallet->amount_fond = $amount;
                $wallet->status = 2;
                $wallet->percentage = $percent;
                $wallet->save();

                $inversion->update([
                    'gain' => $gain + $amount,
                    'capital' => $gain + $amount,
                ]);
            }
        }
    }

    public function retiroCapital()
    {
        $user = Auth::user();
        $inversiones = [];
        if (isset($user->inversiones)) {
            $inversiones = $user->inversiones->where('status', 1);
        }

        return view('retiros.index', compact('inversiones'));
    }

    public function solicitar(Request $request)
    {
        try {
            $inversion = Inversion::findOrFail($request->inversionId);

            $validate = $request->validate([
                'inversionId' => 'required',
                'amount' => 'required'
            ]);

            if ($validate) {
                $Inversion = Inversion::findOrFail($request->inversionId);
                $Inversion->capital -= $request->amount;
                $Inversion->save();
                /* $solicitud = SolicitudRetiro::create([
                    'contracts_id' => $request->contratoId,
                    'amount' => $request->amount,
                    'percentage' => 5,
                    'status' => 0
                ]); */
                return response()->json(true);
            }
        } catch (\Throwable $th) {
            Log::error('InversionController - solicitar -> Error: ' . $th);
            abort(403, "Ocurrió un error, contacte con el administrador");
        }
    }
    public function generarLiquidacion(Request $request)
    {

        $validate = $request->validate([
            'inversionId' => 'required',
            'amount' => 'required',
            'wallet' => 'required',

        ]);

        try {
            if ($validate) {
                $bruto = $request->amount;
                $feed = ($bruto * 0.05);
                $total = $bruto - $feed;
                $user = Auth::user();

                $arrayLiquidation = [
                    'iduser' => $user->id,
                    'total' => $total,
                    'monto_bruto' => $bruto,
                    'feed' => $feed,
                    'hash',
                    'inversion_id' => $request->inversionId,
                    'wallet_used' => $request->wallet,
                    'status' => 0,
                    'type' => 1, //Retiro de capital
                    'code_correo' => null,
                    'fecha_code' => Carbon::now()
                ];

                $liquidacion = Liquidation::create($arrayLiquidation);
                $this->retiroAprobado();
            }
        } catch (\Throwable $th) {
            Log::error('InversionController - saveInversion -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
        return $liquidacion->id;
    }


    /* public function cancelar(Request $request)
    {
        SolicitudRetiro::find($request->solicitudId)->update(['status' => 2]);
        return response()->json(true);
    } */
    public function saveInversion($orden)
    {
        try {
            DB::beginTransaction();

            $data = [
                'orden_id' => $orden->id,
                'user_id' => $orden->user_id,
                'invested' => $orden->amount,
                'capital' => $orden->amount,
            ];
            $contrato = Inversion::create($data);
            $idContrato = $contrato->id;
            // dd($idContrato);
            $user = User::find($orden->user_id);
            $parents = $this->getDataFather($user, 2);

            $user_id = $contrato->user_id;
            $invest = Inversion::where('user_id', '=', $user_id)->count('id');
            /*if ($invest > 1) {
                if (isset($parents)) {
                    foreach ($parents as $parent) {

                        $amount = 0;
                        if ($parent->nivel == 1) {
                            $amount = 0;
                           dd($this->bonoInicio($idContrato, $parent, $amount, $user));
                        } elseif ($parent->nivel == 2) {
                            $amount = 0;
                            $this->bonoInicio($idContrato, $parent, $amount, $user);
                        }
                        $contrato->save();
                    }
                }
            } else {
                if (isset($parents)) {
                    foreach ($parents as $parent) {
                        $amount = 0;
                        if ($parent->nivel == 1) {
                            $amount = 50;
                           $this->bonoInicio($idContrato, $parent, $contrato, $user);
                        } elseif ($parent->nivel == 2) {
                            $amount = 20;
                            $this->bonoInicio($idContrato, $parent, $contrato, $user);
                        }
                        $contrato->save();
                    }
                }
            }

            */
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('InversionController - saveInversion -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }


    public function bonoInicio($inversion, $user, $amount, $child)
    {

        $total = $amount->invested * 0.25;

        $wallet = Wallet::create([
            'user_id' => $user->id,
            'referred_id' => $child->id,
            'inversion_id' => $inversion,
            'amount' => $total,
            'amount_fondo' => $total,
            'descripcion' => 'Bono Inicio nivel ' . $user->nivel,
            'type' => ($user->nivel == 1 ? 0 : $user->nivel == 2) ?  6 : 0,
        ]);
    }

    public function bonoRecompra($idContrato, $user, $amount, $level = null, $referred)
    {

        $usuario = $user[0];

        if ($level != null && $level == 1) {
            if (($amount >= 500) &&
                ($amount <= 5000)
            ) {
                $recompra = 4;
            } elseif (($amount >= 5001) &&
                ($amount <= 15000)
            ) {
                $recompra = 7;
            } elseif (($amount >= 15001) &&
                ($amount <= 30000)
            ) {
                $recompra = 12;
            } elseif (($amount >= 30001) &&
                ($amount <= 50000)
            ) {
                $recompra = 17;
            } elseif (($amount >= 50001) &&
                ($amount <= 150000)
            ) {
                $recompra = 27;
            } elseif (($amount >= 150001) &&
                ($amount <= 300000)
            ) {
                $recompra = 32;
            } else {
                $recompra = 0;
            }
        } else {
            if (($amount >= 500) &&
                ($amount <= 5000)
            ) {
                $recompra = 4;
            } elseif (($amount >= 5001) &&
                ($amount <= 15000)
            ) {
                $recompra = 7;
            } elseif (($amount >= 15001) &&
                ($amount <= 30000)
            ) {
                $recompra = 12;
            } elseif (($amount >= 30001) &&
                ($amount <= 50000)
            ) {
                $recompra = 17;
            } elseif (($amount >= 50001) &&
                ($amount <= 150000)
            ) {
                $recompra = 27;
            } elseif (($amount >= 150001) &&
                ($amount <= 300000)
            ) {
                $recompra = 32;
            } else {
                $recompra = 0;
            }
        }


        $this->saveBonoRecompra($idContrato, $usuario, $recompra, $referred);
    }

    public function saveBonoRecompra($inversion, $user, $amount, $referred)
    {
        Wallet::create([
            'user_id' => $user->id,
            'referred_id' => $referred->id,
            'inversion_id' => $inversion,
            'amount' => $amount,
            'amount_fondo' => $amount,
            'descripcion' => 'Bono Recompra',
            'type' => 1,
        ]);

        $inversion = Inversion::find($inversion);
        // $inversion->gain+= $amount;
        $inversion->save();
    }

    public function rentabilidad()
    {
        $rentabilidades = Rentabilidad::orderBy('id', 'desc')->get();

        return view('inversion.rentabilidad', compact('rentabilidades'));
    }

    public function porcentajeRentabilidad(Request $request)
    {
        $porcentaje = ($request->porcentaje / 100);

        PorcentajeRentabilidad::create([
            'porcentaje' => $porcentaje,
        ]);

        return back()->with('success', 'porcentaje actualizado exitosamente');
    }

    public function pagarRentabilidad()
    {
        try {
            DB::beginTransaction();

            $porcentaje = PorcentajeRentabilidad::orderBy('id', 'desc')->first();

            if (!isset($porcentaje)) {
                return redirect()->route('rentabilidad')->with('status', 'No se ha especificado un porcentaje de rentabilidad');
            } else {
                $porcentaje = ($porcentaje->porcentaje / 20);

                $porcentajes = collect();

                for ($i = -0.10; $i <= 0.10; $i = $i + 0.01) {
                    $valor = $porcentaje + ($porcentaje * $i);
                    $porcentajes->push($valor);
                    //dump($valor);
                }

                $porcentajeRandom = $porcentajes->random();

                $porcentaje = $porcentajeRandom;


                $ids = [];
                $gain = 0;

                $inversiones = Inversion::where([['status', '=', 1], ['pay_rentabilidad', '=', 2]])->whereHas('orden.user', function ($user) use ($ids) {
                })->get();
                $today = Carbon::now();
                $amount = 0;
                //if (($today->isMonday()) || ($today->isTuesday()) || ($today->isWednesday()) || ($today->isThursday()) || ($today->isFriday())) {
                $sumaRentabilidad = 0;
                $rentabilidad = new Rentabilidad;
                $rentabilidad->gain = 0;
                $rentabilidad->percentage = $porcentaje;
                $rentabilidad->payment_date = Carbon::now();
                $rentabilidad->status = 0;
                $rentabilidad->save();
                foreach ($inversiones as $inversion) {
                    $previoues_capital = $inversion->capital;
                    $wallet = new Wallet;
                    $wallet->user_id = $inversion->user_id;
                    $wallet->inversion_id = $inversion->id;
                    $wallet->amount = $inversion->capital * $porcentaje;
                    $wallet->amount_fondo = $inversion->capital * $porcentaje;
                    $wallet->percentage = $porcentaje;
                    $wallet->type = 5;
                    $wallet->descripcion = "Pago Rentabilidad";
                    $wallet->save();

                    //$rentabilidadGanancias =  Wallet::where('inversion_id', $inversion->id)->where('type', '!=' , 5)->orderBy('id')->get();

                    $sumaRentabilidad += $inversion->capital * $porcentaje;
                    //}



                    $gain = $inversion->capital * $porcentaje;
                    $inversion->gain += $inversion->capital * $porcentaje;
                    $inversion->save();

                    $current_capital = $inversion->capital;


                    $log_rentabilidad = new Log_rentabilidad;
                    $log_rentabilidad->rentabilidad_id = $rentabilidad->id;
                    $log_rentabilidad->inversion_id = $inversion->id;
                    $log_rentabilidad->wallet_id = $wallet != null ? $wallet->id : null;
                    $log_rentabilidad->percentage = $porcentaje;
                    $log_rentabilidad->amount = $wallet->amount;
                    $log_rentabilidad->payment_date = $today;
                    $log_rentabilidad->previoues_capital = $previoues_capital;
                    $log_rentabilidad->current_capital = $current_capital;
                    $log_rentabilidad->save();

                    $amount += $wallet->amount;

                    $ids[] = $log_rentabilidad->id;
                }

                // }

                $rentabilidad->gain = $sumaRentabilidad;
                $rentabilidad->update();
            }
            DB::commit();
            //return ['ids' => $ids, 'gain' => $gain];
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('InversionController - pagarRentabilidad -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }


    public function licenses(Request $request)
    {
        $user_id = null;
        $email = null;
        $date_from = null;
        $date_to = null;
        $licenses_list = [];
        
        if($request->isMethod('post'))
        {
            $request->all();

            $query = Investment::where('status', 1);

            if($request->has('user_id') && $request->user_id !== null) 
            {
                $user_id = $request->user_id;

                $query->whereHas('user', function($q) use($user_id){
                    $q->where('id', $user_id);
                });
            }

            if($request->has('email') && $request->email !== null) 
            {
                $email = $request->email;

                $query->whereHas('user', function($q) use($email){
                    $q->where('email', $email);
                });
            }

            if($request->has('licenses_list') && $request->licenses_list !== null)
            {

                $licenses_list = $request->licenses_list;
                $query->whereIn('package_id', $licenses_list);

            }

            if($request->has('date_from') && $request->date_from !== null && $request->has('date_to') && $request->date_to != null)
            {
                $date_from = $request->date_from;

                $date_to = $request->date_to;

                $query->whereDate('created_at', '>=', $date_from)
                      ->whereDate('created_at', '<=', $date_to);
            }

            $licenses = $query->get();
            return view('licenses.index',compact('licenses', 'user_id', 'email', 'date_from', 'date_to', 'licenses_list'));
        }
        $licenses = Investment::where('status', 1)->get();
        return view('licenses.index',compact('licenses', 'user_id', 'email', 'date_from', 'date_to', 'licenses_list'));
    }
}
