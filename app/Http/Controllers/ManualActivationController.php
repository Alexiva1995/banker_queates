<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MembershipType;
use App\Models\MembershipPackage;
use App\Models\PoolGlobal;
use App\Models\AlertNotification;
use App\Models\Inversion;
use App\Models\Investment;
use App\Models\Order;
use App\Models\WalletComission;
use App\Services\BonusService;
use App\Models\Level;

class ManualActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (isset($request->email)) {
            $user = User::where('email', $request->email)->first();
            if ($user->admin == '1') return redirect()->back()->with('error', '¡No se puede activar membresía a un Administrador!');
            // if ($user->status === '1') {
                $member = Investment::where('user_id', $user->id)->orderBy('id', 'DESC')->first();
                $data = MembershipType::with('MembershipPackage')->get();
                $memberships = Investment::where([['user_id', $user->id],['status', 1]])->with('order')->get();
                if (!$memberships->isEmpty()) {

                    foreach ($data as $type) {
                        $type->MembershipPackage = $type->MembershipPackage->sortBy('amount');
                    }
                    foreach ($data as $type) {
                        foreach ($type->MembershipPackage as $package){
                            $package->disabled = false;
                            // $package->textBono = 'Con Bono';
                            // $package->textNone = 'Sin Bono';
                            $bonus=WalletComission::where('buyer_id', $user->id)->where('amount', $package->amount)->first();
                            foreach ($memberships as $membership){
                                $package->pay_utility=$membership->pay_utility;
                                if($bonus){
                                    $package->comision=true;
                                }
                                 if ($package->membership_types_id == $membership->membershipPackage->membership_types_id){
                                    if ($package->amount <= $membership->invested){
                                        $package->disabled = true;
                                    }
                                    if ($package->id === $membership->package_id){
                                        $package->text = "Adquirido";
                                    }
                                    if ($package->id > $membership->package_id){
                                        $package->upgrade = true;
                                    }
                                }
                            }
                        }
                    }
                }
                else{


                    foreach ($data as $type) {

                        $type->MembershipPackage = $type->MembershipPackage->sortBy('amount');
                    }
                    foreach ($data as $type) {

                        foreach ($type->MembershipPackage as $package){

                            $package->disabled = false;
                            $package->upgrade = false;
                            // $package->textBono = 'Con Bono';
                            // $package->textNone = 'Sin Bono';

                        }
                    }

                }
                return view('manualActivation.index', compact('data', 'user'));
           /* }
            else{
                return redirect()->back()->with('error', 'El usuario no está activo');
                // $data = [];
                // return view('manualActivation.index', compact('data', 'user'));
            }*/

        } else {
            return view('manualActivation.search');
        }

    }
    public function searchEmail(Request $request) {
        //dd($request);
        $data = request()->validate([
            "email" => "required|email|exists:users",
        ], [
            "email.required" => "Por favor ingrese un correo",
            "email.email" => "Debe de ingresar un correo valido",
            "email.exist" => "El correo ingresado no existe en nuestro registro"
        ]);
        return $this->index($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = User::findOrFail($request->user);
        $memberShips = Investment::where([['user_id', $request->user],['status', '1']])->first();
        $packageType = MembershipPackage::findOrFail($request->package);
        $investment = Investment::where('user_id', $user->id)->where('type', $packageType->membership_types_id)->where('status', 1)->first();
        $amount = $packageType->amount;
        if ($investment != null) {
            $amount -= $investment->invested;
            $rentability = 0;
            if(!$request->rentability){
                $rentability = 1;
            }
            $order_old_id = $memberShips->order_id;
            $order = Order::create([
                'amount' => $amount,
                'type' => '0',
                'package_id' => $request->package,
                'fee' => 15,
                'status' => '1',
                'user_id' => $request->user,
            ]);

            Investment::where('order_id',$order_old_id)->update([
                'package_id' => $request->package,
                'payment_plataform'=>'1',
                'invested' => $packageType->amount,
                'type' => $packageType->membership_types_id,
                'order_id' => $order->id,
                'status' => '1',
                'pay_utility'=>$rentability,
                'buyer_id' => $user->buyer_id
            ]);
            User::where('id', $request->user)->update(['status'=>'1']);
            if($request->comision=='on'){
                $this->callBuildingBonus($order);
            }
        } else{
            $rentability=0;

            if(!$request->rentability){
                $rentability=1;
            }

            $order = Order::create([
                'amount' => $packageType->amount,
                'type' => '0',
                'package_id' => $request->package,
                'fee' => 15,
                'status' => '1',
                'user_id' => $request->user,
            ]);

            Investment::create([
                'invested' => $packageType->amount,
                'package_id' => $packageType->id,
                'type' => $packageType->membership_types_id,
                'user_id' =>$order->user_id,
                'payment_plataform'=>'1',
                'order_id' => $order->id,
                'status' => '1',
                'gain'=> 0,
                'capital'=>0,
                'pay_utility'=>$rentability,
                'buyer_id' => $user->buyer_id
            ]);
            User::where('id', $request->user)->update(['status'=>'1']);
            if($request->comision=='on'){
                $this->callBuildingBonus($order);
            }
        }
        return redirect()->route('activation.index')->with('success', 'Activación de Membresía Existosa');
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
    //Suma los montos correspondientes al pool global actual

    private function typeOrden($id)
    {
        if ($id == 1) {
            return 'Bronce';
        }else if($id == 2) {
            return 'Plata';
        }else if($id == 3) {
            return 'Oro';
        }else if($id == 4) {
            return 'Platino';
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
