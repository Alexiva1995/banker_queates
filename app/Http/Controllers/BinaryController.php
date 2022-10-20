<?php

namespace App\Http\Controllers;

use App\Models\BinaryPoint;
use App\Models\Investment;
use App\Models\User;
use App\Models\WalletComission;
use Illuminate\Database\Eloquent\Collection;
class BinaryController extends Controller
{
    /**
     * Procedimiento de corte binario (proviene de Terra)
     */
    public function usdtbonobinario()
    {

        $point_group = BinaryPoint::where('status', 0)->select('user_id')->groupBy('user_id')->get();

        foreach ($point_group as $item) {

            $id = $item->user_id;
            $usuario = User::findOrFail($id);
            // Valida si el referido tiene un hijo directo por cada lado 
            $padre_id = $usuario->padre->id;
            $referred_left = User::where('binary_id', $padre_id)->where('binary_side', 'L')->exists();
            $referred_right = User::where('binary_id', $padre_id)->where('binary_side', 'R')->exists();

            if ($referred_left && $referred_right) {

                $binary_points = BinaryPoint::where('user_id', $id)->where('status', 0)->get();

                $point_right = BinaryPoint::where('user_id', $id)->where('status', 0)->sum('right_points');

                $point_left = BinaryPoint::where('user_id', $id)->where('status', 0)->sum('left_points');

                $menber = Investment::where('user_id', $id)->where('status', '1')->first();

                $user_referred = User::where('id', $id)->first();

                $point_A = BinaryPoint::where('user_id', $id)->where('status', 0)->where('right_points', '0')->first();

                $point_B = BinaryPoint::where('user_id', $id)->where('status', 0)->where('left_points', '0')->first();

                $point_ulti = BinaryPoint::where('user_id', $id)->where('status', 0)->orderBy('id', 'DESC')->first();

                $date = now();

                // Armamos una coleccion o lista para contener los elementos a trabajar en su respectivo lado
                $lista_pierna_derecha = new Collection();
                $lista_pierna_izquierda = new Collection();

                //datos dentro del rango de fechas
                $dataWeek = WalletComission::where('user_id', $id)->sum('amount');

                $resta = $point_right - $point_left;

                $resta = -$resta;
                // Invierte los valores en caso de generar resultados negativos
                if ($resta < 0) $resta = -$resta;
                if ($point_right < $point_left) {
                    if ($point_right >= 150) {
                        if ($id != 1) {
                            if ($menber != null) {
                                // Se aplica el 20%
                                $bonus_t = $point_right * 0.20;
                                // $this->createBonusBinariRight($id,$bonus_t, $point_right, $user_referred);
                            }
                            // Asignamos cada elemento a la lista en la cual correspondan.
                            foreach ($binary_points as $binary_point) {

                                if ($binary_point->right_points > 0) {
                                    $lista_pierna_derecha->push($binary_point);
                                } else {
                                    $lista_pierna_izquierda->push($binary_point);
                                }
                            }
                            $this->subtractPointsWhenLeftItsMayor($lista_pierna_derecha, $lista_pierna_izquierda);
                        }
                    }
                } elseif ($point_right > $point_left) {
                    if ($point_left >= 150) {

                        if ($id != 1) {
                            // Asignamos cada elemento a la lista en la cual correspondan.
                            foreach ($binary_points as $binary_point) {

                                if ($binary_point->left_points > 0) {
                                    $lista_pierna_izquierda->push($binary_point);
                                } else {
                                    $lista_pierna_derecha->push($binary_point);
                                }
                            }
                            $this->subtractPointsWhenRightItsMayor($lista_pierna_izquierda, $lista_pierna_derecha);
                        }
                    }

                }
                // }elseif($point_right == $point_left){
                //     // TODO: Preguntar que pasa si ambas piernas son iguales
                //     if($point_right >= 150) {
                //         if ($id != 1) {
                //             if ( !empty($pakage) && $pakage->package_id == 5 ) {

                //                 $amount=$pakage->balance_initial;

                //                 $date = Carbon::now()->toDateString();

                //                 $bonus_all = Bonus::where('user_id', $id)->whereDate('created_at', $date)->whereIn('type',['0','1','2','6'])->where('status',0)->sum('amount');
                //                 $bonus = $bonus_all == null ? $bonus_all = 0 : $bonus_all;
                //                 $cont = 5;

                //                 if($bonus<$amount){

                //                     if($amount<$bonus+((9/100)*$point_left)){

                //                         $bonus_t=(9/100)$point_left+$amount-$bonus-(9/100)$point_left;

                //                     } else{
                //                         $bonus_t = (9/100)*$point_left;

                //                     }

                //                 Bonus::Create([
                //                     'type' => 2,
                //                     'user_id'=> $id,
                //                     'amount' => $bonus_t,
                //                     'refered_id' => $user_referred->referred_id,
                //                 ]);

                //                 $this->bonusService->bonusDiamondGenerational($user_referred, $bonus_t, $user_referred->id, $cont);
                //                 }

                //                 // $puntos_rango =  ($bonus_t/(9/100)) * 2;
                //                 // $this->bonusService->assignPointsRangeRecursively($user_referred, $puntos_rango);
                //             }elseif( !empty($pakage) && $pakage->package_id == 6 ) {

                //                 $amount=$pakage->balance_initial;

                //                 $date = Carbon::now()->toDateString();

                //                 $bonus_all = Bonus::where('user_id', $id)->whereDate('created_at', $date)->whereIn('type',['0','1','2','6'])->where('status',0)->sum('amount');
                //                 $bonus = $bonus_all == null ? $bonus_all = 0 : $bonus_all;
                //                 $cont=5;

                //                 if($bonus<$amount) {

                //                     if($amount<$bonus+((10/100)*$point_left)){

                //                         $bonus_t=(10/100)$point_left+$amount-$bonus-(10/100)$point_left;

                //                     } else{
                //                         $bonus_t = (10/100)*$point_left;

                //                     }

                //                     Bonus::Create([
                //                         'type' => 2, 
                //                         'user_id'=> $id,
                //                         'amount' => $bonus_t,
                //                         'refered_id' => $user_referred->referred_id,
                //                     ]);

                //                     $this->bonusService->bonusDiamondGenerational($user_referred, $bonus_t, $user_referred->id, $cont);

                //                     // $puntos_rango =  ($bonus_t/(10/100)) * 2;
                //                     // $this->bonusService->assignPointsRangeRecursively($user_referred, $puntos_rango);
                //                 }
                //             }elseif( !empty($pakage) && $pakage->package_id == 7 ) {

                //                 $amount=$pakage->balance_initial;

                //                 $date = Carbon::now()->toDateString();

                //                 $bonus_all = Bonus::where('user_id', $id)->whereDate('created_at', $date)->whereIn('type',['0','1','2','6'])->where('status',0)->sum('amount');
                //                 $bonus = $bonus_all == null ? $bonus_all = 0 : $bonus_all;
                //                 $cont=5;

                //                 if($bonus<$amount) {

                //                     if($amount<$bonus+((12/100)*$point_left)) {

                //                         $bonus_t=(12/100)$point_left+$amount-$bonus-(12/100)$point_left;

                //                     } else{

                //                         $bonus_t = (12/100)*$point_left;
                //                     }
                //                     Bonus::Create([
                //                         'type' => 2,
                //                         'user_id'=> $id,
                //                         'amount' =>$bonus_t,
                //                         'refered_id' => $user_referred->referred_id,
                //                     ]);

                //                     $this->bonusService->bonusDiamondGenerational($user_referred, $bonus_t, $user_referred->id, $cont);

                //                     // $puntos_rango =  ($bonus_t/(12/100)) * 2;
                //                     // $this->bonusService->assignPointsRangeRecursively($user_referred, $puntos_rango);
                //                 }

                //             }elseif( !empty($pakage) && $pakage->package_id == 8 ) {
                //                 $amount=$pakage->balance_initial;

                //                 $date = Carbon::now()->toDateString();

                //                 $bonus_all = Bonus::where('user_id', $id)->whereDate('created_at', $date)->whereIn('type',['0','1','2','6'])->where('status',0)->sum('amount');
                //                 $bonus = $bonus_all == null ? $bonus_all = 0 : $bonus_all;
                //                 $cont=5;

                //                 if($bonus<$amount){

                //                     if($amount<$bonus+((14/100)*$point_left)){

                //                         $bonus_t=(14/100)$point_left+$amount-$bonus-(14/100)$point_left;

                //                     } else{

                //                         $bonus_t = (14/100)*$point_left;
                //                     }

                //                     Bonus::Create([
                //                         'type' => 2,
                //                         'user_id'=> $id,
                //                         'amount' => $bonus_t,
                //                         'refered_id' => $user_referred->referred_id,
                //                     ]);

                //                     $this->bonusService->bonusDiamondGenerational($user_referred, $bonus_t, $user_referred->id, $cont);

                //                     // $puntos_rango =  ($bonus_t/(14/100)) * 2;
                //                     // $this->bonusService->assignPointsRangeRecursively($user_referred, $puntos_rango);
                //                 }

                //             }elseif( !empty($pakage) && ($pakage->package_id == 9 ||  $pakage->package_id == 10) ) {

                //                 $amount=$pakage->balance_initial;

                //                 $date = Carbon::now()->toDateString();

                //                 $bonus_all = Bonus::where('user_id', $id)->whereDate('created_at', $date)->whereIn('type',['0','1','2','6'])->where('status',0)->sum('amount');
                //                 $bonus = $bonus_all == null ? $bonus_all = 0 : $bonus_all;
                //                 $cont=5;

                //                 if($bonus<$amount) {

                //                     if($amount<$bonus+((16/100)*$point_left)){

                //                         $bonus_t=(16/100)$point_left+$amount-$bonus-(16/100)$point_left;

                //                     } else{
                //                         $bonus_t = (16/100)*$point_left;

                //                     }

                //                     Bonus::Create([
                //                         'type' => 2,
                //                         'user_id'=> $id,
                //                         'amount' =>$bonus_t,
                //                         'refered_id' => $user_referred->referred_id,
                //                     ]);

                //                     $this->bonusService->bonusDiamondGenerational($user_referred, $bonus_t, $user_referred->id, $cont);

                //                     // $puntos_rango =  ($bonus_t/(16/100)) * 2;
                //                     // $this->bonusService->assignPointsRangeRecursively($user_referred, $puntos_rango);
                //                 }
                //             }elseif(empty($pakage) || (!empty($pakage) && ($pakage->package_id == 4 || $pakage->package_id == 3 || $pakage->package_id == 2))) {

                //                 if ($menber != null) {
                //                     $amount = $pakage == null ? $amount=$menber->menber: $amount=$pakage->balance_initial;

                //                     $date = Carbon::now()->toDateString();

                //                     $bonus_all = Bonus::where('user_id', $id)->whereDate('created_at', $date)->whereIn('type',['0','1','2','6'])->where('status',0)->sum('amount');
                //                     $bonus = $bonus_all == null ? $bonus_all = 0 : $bonus_all;
                //                     $cont=5;

                //                     if($bonus<$amount){

                //                         if($amount<$bonus+((8/100)*$point_right)){

                //                             $bonus_t=(8/100)$point_right+$amount-$bonus-(8/100)$point_right;

                //                         } else{
                //                             $bonus_t = (8/100)*$point_right;

                //                         }

                //                         Bonus::Create([
                //                             'type' => 2,
                //                             'user_id'=> $id,
                //                             'amount' => $bonus_t,
                //                             'refered_id' => $user_referred->referred_id,
                //                         ]);

                //                         $this->bonusService->bonusDiamondGenerational($user_referred, $bonus_t, $user_referred->id, $cont);

                //                         // $puntos_rango =  ($bonus_t/(8/100)) * 2;
                //                         // $this->bonusService->assignPointsRangeRecursively($user_referred, $puntos_rango);
                //                     }
                //                 }
                //             }

                //             foreach ($users as $user) {
                //                 $user->status = 1;
                //                 $user->right_binary_points = 0;
                //                 $user->left_binary_points = 0;
                //                 $user->points_pv_L = 0;
                //                 $user->update();

                //             }

                //         }
                //     }
                // }
            }
        }
    }
    /**
     * Crea el bono binario por el lado derecho 
     */
    private function createBonusBinariRight($id, $bonus_t, $point_right, $user_referred)
    {
        if ($bonus_t != 0) {
            WalletComission::Create([
                'type' => 4,
                'user_id' => $id,
                'amount' => $bonus_t,
                'buyer_id' => $user_referred->referred_id,
                'description' => "Puntos que se utilizaron para generar el bono {$point_right}"
            ]);
        }
    }
    /**
     * Realiza la resta de los puntos cuando el lado mayor es el izquierdo y el derecho es menor
     * @param Illuminate\Database\Eloquent\Collection El primer parametro es la coleccion que contiene los elementos del lado menor
     * @param Illuminate\Database\Eloquent\Collection El segundo parametro es la coleccion que contiene los elementos del lado mayor
     */
    private function subtractPointsWhenLeftItsMayor($lista_saldo_menor, $lista_saldo_mayor)
    {
        // variable que se emplea para recorrer los elementos de la lista del lado mayor
        $contador = 0;
        // For para recorrer cada elemento de la lista del lado menor y realizar la resta
        for ($i = 0; $i < count($lista_saldo_menor); $i++) {
            // Realizamos la resta entre el item de la pierna mayor, menos el item de la pierna menor
            $lista_saldo_mayor[$contador]->left_points -= $lista_saldo_menor[$i]->right_points;

            // Si el resultado de la resta es un numero positivo, seguimos restando con ese elemento,
            // Y actualizamos el elemento menor restado a amount 0 y status 1
            if ($lista_saldo_mayor[$contador]->left_points > 0) {
                $lista_saldo_menor[$i]->right_points = 0;
                $lista_saldo_menor[$i]->status = 1;
                $lista_saldo_mayor[$contador]->update();

                //Si el resultado de la resta es un número negativo, asignamos ese resultado
            } else if ($lista_saldo_mayor[$contador]->left_points <= 0) {
                // Asignamos el número negativo al elemento de la pierna menor, multiplicandolo por -1 para guardarlo
                // como positivo.
                // Y actualizamos el elemento de la lista de la pierna mayor a 0 y status 1
                $lista_saldo_menor[$i]->right_points = $lista_saldo_mayor[$contador]->left_points * -1;
                $lista_saldo_mayor[$contador]->left_points = 0;
                $lista_saldo_mayor[$contador]->status = 1;

                $lista_saldo_mayor[$contador]->update();

                $contador++;
                
                $i--;
            }
            $lista_saldo_menor[$i]->update();
        }
    }
    /**
     * Realiza la resta de los puntos cuando el lado mayor es el derecho y el izquierdo es menor
     * @param Illuminate\Database\Eloquent\Collection El primer parametro es la coleccion que contiene los elementos del lado menor
     * @param Illuminate\Database\Eloquent\Collection El segundo parametro es la coleccion que contiene los elementos del lado mayor
     */
    private function subtractPointsWhenRightItsMayor($lista_saldo_menor, $lista_saldo_mayor)
    {
        // variable que se emplea para recorrer los elementos de la lista del lado mayor
        $contador = 0;
        // For para recorrer cada elemento de la lista del lado menor y realizar la resta
        for ($i = 0; $i < count($lista_saldo_menor); $i++) {
            // Realizamos la resta entre el item de la pierna mayor, menos el item de la pierna menor
            $lista_saldo_mayor[$contador]->right_points -= $lista_saldo_menor[$i]->left_points;

            // Si el resultado de la resta es un numero positivo, seguimos restando con ese elemento,
            // Y actualizamos el elemento menor restado a amount 0 y status 1
            if ($lista_saldo_mayor[$contador]->right_points > 0) {
                $lista_saldo_menor[$i]->left_points = 0;
                $lista_saldo_menor[$i]->status = 1;
                $lista_saldo_mayor[$contador]->update();

                //Si el resultado de la resta es un número negativo, asignamos ese resultado
            } else if ($lista_saldo_mayor[$contador]->right_points <= 0) {
                // Asignamos el número negativo al elemento de la pierna menor, multiplicandolo por -1 para guardarlo
                // como positivo.
                // Y actualizamos el elemento de la lista de la pierna mayor a 0 y status 1
                $lista_saldo_menor[$i]->left_points = $lista_saldo_mayor[$contador]->right_points * -1;
                $lista_saldo_mayor[$contador]->right_points = 0;
                $lista_saldo_mayor[$contador]->status = 1;

                $lista_saldo_mayor[$contador]->update();

                $contador++;
                
                $i--;
            }
            $lista_saldo_menor[$i]->update();
        }
    }
}
