<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WalletComission;
use Illuminate\Http\Request;

class BonoManualController extends Controller
{
    public function index(){
        $usuarios = User::all();

        foreach($usuarios as $user){
           $user->saldo_disponible = $user->getWallet->sum('amount_available');
        }

        return view('bonoManual.index' , compact('usuarios'));
    }

    public function agregar_saldo(Request $request){
        $user_id = $request->user_id;
        $monto_a_agregar = $request->monto_a_agregar;
        if($monto_a_agregar > 0){
            $data = [
                'user_id'=>$user_id,
                'amount'=> $monto_a_agregar,
                'amount_available'=> $monto_a_agregar,
                'level'=>0,
                'description'=> 'monto agregado manualmente'
            ];
            WalletComission::create($data);
            return response()->json(['value' =>  'succes']);
        }else{
            return response()->json(['value' =>  'error']);

        }
    }
}
