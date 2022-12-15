<?php

namespace App\Http\Controllers;

use App\Models\Liquidation;
use App\Models\ManualBonusLog;
use App\Models\User;
use App\Models\WalletComission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BonoManualController extends Controller
{
    public function search(){

        return view('bonoManual.search');
    }
    public function searchPost(Request $request)
    {
        $usuario = User::where('id', $request->id)->get();

        if ($usuario == null) {
            return back()->with('error', 'Usuario no existe por favor verifique');
        }else{

            return $this->index($usuario);
        }
    }

    public function index($user){

        $usuarios = User::where('id', $user[0]->id)->get();

        foreach($usuarios as $user){
           $user->saldo_disponible = $user->getWallet->sum('amount_available');
        }

        return view('bonoManual.index' , compact('usuarios'));
    }

    public function agregar_saldo(Request $request) 
    {
        $user_id = $request->user_id;
        $monto_a_agregar = $request->monto_a_agregar;
        $descripcion = $request->descripcion;
        if($monto_a_agregar > 0 && !empty($descripcion)){
            $data = [
                'user_id'=>$user_id,
                'amount'=> $monto_a_agregar,
                'amount_available'=> $monto_a_agregar,
                'level'=>0,
                'description'=> $descripcion,
                'type' => 2
            ];
            
            WalletComission::create($data);

            $fields = [
                'author_id' => Auth::user()->id,
                'user_id' => $user_id,
                'amount' => $monto_a_agregar,
                'action' => 'suma de saldo',
            ];

            ManualBonusLog::create($fields);

            return response()->json(['msj' =>  'Saldo agregado correctamente',
                                     'ico'=> 'success' ]);
        }else{

                return response()->json(['msj' =>  'Monto invalido',
                                     'ico'=> 'error' ]);
        }
    }

    public function sustraer_saldo(Request $request){
        $id =  $request->user_id;
        $monto_a_sustraer = $request->monto_a_sustraer;
        $descripcion = $request->description;
        $saldo =  WalletComission::where('user_id',$id)->where('status','0')->get();
        $total = $saldo->sum('amount_available');
        //return  $total - $monto_a_sustraer ;
        if($monto_a_sustraer <= $total  && !empty($descripcion)){
            for($i = 0; $i < count($saldo); $i++){
                $total = $saldo->sum('amount_available');
                if(  $saldo[$i]['amount_available'] - $monto_a_sustraer   <= 0){

                    $monto_a_sustraer =  $monto_a_sustraer - $saldo[$i]['amount_available'] ;
                    $saldo[$i]['amount_available'] = 0;
                    $saldo[$i]['status'] = '4';
                    $saldo[$i]->update();

                }else{
                    $saldo[$i]['amount_available'] = $saldo[$i]['amount_available'] - $monto_a_sustraer;
                    $saldo[$i]->update();
                    $i = count($saldo);
                }
                $liqui = new Liquidation();
                $liqui->user_id = $id;
                $liqui->amount_gross = $monto_a_sustraer;
                $liqui->amount_net = $monto_a_sustraer;
                $liqui->amount_fee = 0;
                $liqui->description = $descripcion;
                $liqui->type = 3;
                $liqui->status = 0;
                $liqui->save();
            }

            $fields = [
                'author_id' => Auth::user()->id,
                'user_id' => $id,
                'amount' => $request->monto_a_sustraer,
                'action' => 'resta de saldo',
            ];

            ManualBonusLog::create($fields);

            return response()->json(['msj' =>  'Saldo sutraido correctamente',
            'ico'=> 'success' ]);
        }else{
            if(empty($descripcion)){
                return response()->json(['msj' =>  'Coloque una descripcion' ,
                                         'ico'=> 'info']);
            }
            return response()->json(['msj' =>  'el monto ingresado supera el saldo disponible de este usuario',
            'ico'=> 'error' ]);
        }

    }

}
