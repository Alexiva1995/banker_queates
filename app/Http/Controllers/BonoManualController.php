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
        $descripcion = $request->descripcion;
        if($monto_a_agregar > 0 && !empty($descripcion)){
            $data = [
                'user_id'=>$user_id,
                'amount'=> $monto_a_agregar,
                'amount_available'=> $monto_a_agregar,
                'level'=>0,
                'description'=> $descripcion
            ];
            WalletComission::create($data);
            return response()->json(['msj' =>  'Saldo agregado correctamente',
                                     'ico'=> 'success' ]);
        }else{
            if(empty($descripcion)){
                return response()->json(['msj' =>  'Coloque una descripcion' ,
                                         'ico'=> 'info']);
            }
                
                return response()->json(['msj' =>  'Monto invalido',
                                     'ico'=> 'error' ]);
        }
    }

    public function sustraer_saldo(Request $request){
       
        $id =  $request->user_id;
        $monto_a_sustraer = $request->monto_a_sustraer;

        $saldo =  WalletComission::where('user_id',$id)->where('status','0')->get();
        $total = $saldo->sum('amount_available');
        //return  $total - $monto_a_sustraer ;
        if($monto_a_sustraer <= $total ){                                                                       
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
            }
            return response()->json(['msj' =>  'Saldo sutraido correctamente',
            'ico'=> 'success' ]);
        }else{
            return response()->json(['msj' =>  'el monto ingresado supera el saldo disponible de este usuario',
            'ico'=> 'error' ]);
        }
        
    }
}
