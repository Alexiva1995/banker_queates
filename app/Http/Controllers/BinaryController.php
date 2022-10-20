<?php

namespace App\Http\Controllers;

use App\Models\BinaryPoint;
use App\Models\Investment;
use App\Models\User;
use App\Models\WalletComission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

            if( $referred_left && $referred_right ) {
                
                $users = BinaryPoint::where('user_id', $id)->where('status',0)->get();
                
                $point_right = BinaryPoint::where('user_id', $id)->where('status', 0)->sum('right_points');

                $point_left = BinaryPoint::where('user_id', $id)->where('status', 0)->sum('left_points');
                
                $menber = Investment::where('user_id', $id)->where('status', '1')->first();
                
                $user_referred = User::where('id',$id)->first(); 
                
                $point_A = BinaryPoint::where('user_id', $id)->where('status', 0)->where('right_points', '0')->first();
                
                $point_B = BinaryPoint::where('user_id', $id)->where('status', 0)->where('left_points', '0')->first();
                
                $point_ulti = BinaryPoint::where('user_id', $id)->where('status',0)->orderBy('id', 'DESC')->first();
    
                $date = now();
    
                //datos dentro del rango de fechas
                $dataWeek = WalletComission::where('user_id',$id)->sum('amount');
    
                $resta = $point_right - $point_left;
               
                $resta = - $resta;
                // Invierte los valores en caso de generar resultados negativos
                if ($resta < 0) $resta = -$resta;
                if ($point_right < $point_left) {
                    Log::debug('Entra a la condicion de que la derecha es menor a la izquierda');
                    if($point_right >= 150) {
                        Log::debug('Los puntos de la pierna son igual o mayor a 150');
                        if ($id != 1) {
                            Log::debug('El ID del usuario es diferente a 1');
                            if ($menber != null) {
                                // Se aplica el 20%
                                $bonus_t = $point_right * 0.20;
                                // $this->createBonusBinariRight($id,$bonus_t, $point_right, $user_referred);
                            }
                            // Iteramos los puntos 
                            for($i = 0; $i < count($users); $i++) {
                                
                                if($users[$i]->right_points === 0) {
                                    $i = $i++; 
                                } else {
                                    $users[$i];
                                    $this->subtractPoints($users, $users[$i]);
                                }

                                // if ($point_right != 0 && $point_left != 0) {
                                //     if (count($users) <= 2) {
                                //         if ($point_B != null) { 
                                //         $point_B->points_pv_R = 0;
                                //         $point_B->status = 1;
                                //         $point_B->update();
                                //         }
                                //         if ($point_A != null) {
                                //             $point_A->points_pv_L = $resta;
                                //             $point_A->status = 0;
                                //             $point_A->update();
                                //         }
                                        
                                //     }elseif(count($users) == 3) {
                                //         $user->points_pv_R = 0;
                                //         $user->update();
        
                                //         if ($user->id != $point_A->id) {
                                            
                                //             $user->points_pv_L = 0;
                                //             $user->points_pv_R = 0;
                                //             $user->status =1;
                                //             $user->update();
                                //         }
                                //         if ($user->id == $point_A->id) {
                                            
                                //             $point_A->points_pv_R = 0;
                                //             $point_A->points_pv_L = $resta;
                                //             $point_A->update();
                                //         }
                                //     }else {
                                //         $user->points_pv_R = 0;
                                //         $user->update();
        
                                //         if ($user->id != $point_ulti->id) {
                                            
                                //             $user->points_pv_L = 0;
                                //             $user->points_pv_R = 0;
                                //             $user->status =1;
                                //             $user->update();
                                //         }
                                //         if ($user->id == $point_ulti->id) {
                                            
                                //             $point_ulti->points_pv_R = 0;
                                //             $point_ulti->points_pv_L = $resta;
                                //             $point_ulti->update();
                                //         }
                                //     }
                                // }
                            }
                        }
                    }
                }
                // elseif($point_right > $point_left){
                //     if($point_left >= 150) {
                    
                //         if ($id != 1) {
                //             if (empty($pakage) || (!empty($pakage) && ($pakage->package_id == 4 || $pakage->package_id == 3 || $pakage->package_id == 2)) || ($pakage->package_id == null) )  {
                                
                //                 if ($menber != null) {
                                    
                //                     $bonus_t = (8/100)*$point_left;
                //                     if (empty($pakage)  && $menber->type == 0 && $dataWeek <= 250 ) {
    
                //                         $diferencia = 250 - $dataWeek;
                //                         $this->conditionalBonusLeft($id,$point_left,$user_referred,$bonus_t,$diferencia);
                //                     }
                //                     if (!empty($pakage) && $pakage->balance_initial == 100 && $dataWeek <= 500){
                                        
                //                         $diferencia = 500 - $dataWeek;
                //                         $this->conditionalBonusLeft($id,$point_left,$user_referred,$bonus_t,$diferencia);
                //                     }
                //                     if (!empty($pakage) && $pakage->balance_initial == 250 || $menber->type == 1 && $dataWeek <= 1000) {
                //                         $diferencia = 1000 - $dataWeek;
                //                         $this->conditionalBonusLeft($id,$point_left,$user_referred,$bonus_t,$diferencia);
                //                     }
                //                     if (!empty($pakage) && $pakage->balance_initial == 500 || $menber->type == 2 && $dataWeek <= 2500) {
                //                         $diferencia = 2500 - $dataWeek;
                //                         $this->conditionalBonusLeft($id,$point_left,$user_referred,$bonus_t,$diferencia);
                //                     }
                //                 }
                            
                        
                //             }elseif( !empty($pakage) && $pakage->package_id == 6 ){
    
                                
                //                 $amount=$pakage->balance_initial;
    
                //                 $date = Carbon::now()->toDateString();
    
                //                 $bonus_all = Bonus::where('user_id', $id)->whereDate('created_at', $date)->whereIn('type',['0','1','2','6'])->where('status',0)->sum('amount');
                //                 $bonus = $bonus_all == null ? $bonus_all = 0 : $bonus_all;
                                
    
                //                 if($bonus<$amount) {
                                
                //                     if($amount<$bonus+((10/100)*$point_left)){
                                        
                //                         $bonus_t=(10/100)$point_left+$amount-$bonus-(10/100)$point_left;
                                        
                //                     } else{
                //                         $bonus_t = (10/100)*$point_left;
        
                //                     }
                                    
                //                     $this->createBonusBinariLeft($id,$bonus_t,$point_left,$user_referred);
                                
                //                 // $puntos_rango =  ($bonus_t/(10/100)) * 2;
                //                 // $this->bonusService->assignPointsRangeRecursively($user_referred, $puntos_rango);
                //                 }
                //             }elseif( !empty($pakage) && $pakage->package_id == 7 ) {
    
                //                 $amount=$pakage->balance_initial;
    
                //                 $date = Carbon::now()->toDateString();
    
                //                 $bonus_all = Bonus::where('user_id', $id)->whereDate('created_at', $date)->whereIn('type',['0','1','2','6'])->where('status',0)->sum('amount');
                //                 $bonus = $bonus_all == null ? $bonus_all = 0 : $bonus_all;
                                
    
                //                 if($bonus<$amount){
                                
                //                     if($amount<$bonus+((12/100)*$point_left)){
                                        
                //                         $bonus_t=(12/100)$point_left+$amount-$bonus-(12/100)$point_left;
                                        
                //                     } else{
                //                         $bonus_t = (12/100)*$point_left;
        
                //                     }
                //                     $this->createBonusBinariLeft($id,$bonus_t,$point_left,$user_referred);
                                
                //                 // $puntos_rango =  ($bonus_t/(12/100)) * 2;
                //                 // $this->bonusService->assignPointsRangeRecursively($user_referred, $puntos_rango); 
                //                 }
                        
                //             }elseif( !empty($pakage) && $pakage->package_id == 8 ) {
    
                                
                //                 $amount=$pakage->balance_initial;
    
                //                 $date = Carbon::now()->toDateString();
    
                //                 $bonus_all = Bonus::where('user_id', $id)->whereDate('created_at', $date)->whereIn('type',['0','1','2','6'])->where('status',0)->sum('amount');
                //                 $bonus = $bonus_all == null ? $bonus_all = 0 : $bonus_all;
                                
    
                //                 if($bonus<$amount){
                                
                //                     if($amount<$bonus+((14/100)*$point_left)){
                                        
                //                         $bonus_t=(14/100)$point_left+$amount-$bonus-(14/100)$point_left;
                                        
                //                     } else{
                //                         $bonus_t = (14/100)*$point_left;
        
                //                     }
                                    
                //                     $this->createBonusBinariLeft($id,$bonus_t,$point_left,$user_referred);
                                
                //                     // $puntos_rango =  ($bonus_t/(14/100)) * 2;
                //                     // $this->bonusService->assignPointsRangeRecursively($user_referred, $puntos_rango);
                //                 }
                        
                //             }elseif( !empty($pakage) && ($pakage->package_id == 9 ||  $pakage->package_id == 10) ) {
    
                //                 $amount=$pakage->balance_initial;
    
                //                 $date = Carbon::now()->toDateString();
    
                //                 $bonus_all = Bonus::where('user_id', $id)->whereDate('created_at', $date)->whereIn('type',['0','1','2','6'])->where('status',0)->sum('amount');
                //                 $bonus = $bonus_all == null ? $bonus_all = 0 : $bonus_all;
                                
    
                //                 if($bonus<$amount) {
                                
                //                     if($amount<$bonus+((16/100)*$point_left)){
                                        
                //                         $bonus_t=(16/100)$point_left+$amount-$bonus-(16/100)$point_left;
                                        
                //                     } else{
                //                         $bonus_t = (16/100)*$point_left;
        
                //                     }
                //                     $this->createBonusBinariLeft($id,$bonus_t,$point_left,$user_referred);
                                
                //                 // $puntos_rango =  ($bonus_t/(16/100)) * 2;
                //                 // $this->bonusService->assignPointsRangeRecursively($user_referred, $puntos_rango);
                //                 }
                //             }elseif( !empty($pakage) && $pakage->package_id == 5 ) {
    
                //                 $amount=$pakage->balance_initial;
    
                //                 $date = Carbon::now()->toDateString();
    
                //                 $bonus_all = Bonus::where('user_id', $id)->whereDate('created_at', $date)->whereIn('type',['0','1','2','6'])->where('status',0)->sum('amount');
                //                 $bonus = $bonus_all == null ? $bonus_all = 0 : $bonus_all;
                                
    
                //                 if($bonus<$amount){
                                
                //                     if($amount<$bonus+((9/100)*$point_left)){
                                        
                //                         $bonus_t=(9/100)$point_left+$amount-$bonus-(9/100)$point_left;
                                        
                //                     } else{
                //                         $bonus_t = (9/100)*$point_left;
                //                     }
                //                     $this->createBonusBinariLeft($id,$bonus_t,$point_left,$user_referred);
                            
                //                 }
                            
                //                 // $puntos_rango =  ($bonus_t/(9/100)) * 2;
                //                 // $this->bonusService->assignPointsRangeRecursively($user_referred, $puntos_rango); 
                //             }
    
                //             foreach ($users as $user) {
                //                 if ($point_right != 0 && $point_left != 0) {
                //                     if (count($users)<= 2) {
                //                         if ($point_A != null) {
                //                                 $point_A->points_pv_L = 0;
                //                                 $point_A->status = 1;
                //                                 $point_A->update();
                //                         }
                //                         if ($point_B != null) {
                //                             $point_B->points_pv_R = $resta; 
                //                             $point_B->status = 0;
                //                             $point_B->update();
                //                         }                                
                                            
                //                     }elseif((count($users)== 3)) {
                                        
                //                         $user->points_pv_L = 0;
                //                         $user->update();
                                                
                //                         if ($user->id != $point_B->id) {
                                            
                //                             $user->points_pv_L = 0;
                //                             $user->points_pv_R = 0;
                //                             $user->status = 1;
                //                             $user->update();
                //                         }
                //                         if ($user->id == $point_B->id) { 
                                            
                //                             $point_B->points_pv_L = 0;
                //                             $point_B->points_pv_R = $resta;
                                            
                //                             $point_B->update();
                //                         }
                //                     }else {
                //                         $user->points_pv_L = 0;
                //                         $user->update();
                                                
                //                         if ($user->id != $point_ulti->id) {
                                            
                //                             $user->points_pv_L = 0;
                //                             $user->points_pv_R = 0;
                //                             $user->status = 1;
                //                             $user->update();
                //                         }
                //                         if ($user->id == $point_ulti->id) { 
                                            
                //                             $point_ulti->points_pv_L = 0;
                //                             $point_ulti->points_pv_R = $resta;
                                            
                //                             $point_ulti->update();
                //                         }
                //                     }
                //                 }    
                //             }
                //         }
                //     }
                    
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
    private function createBonusBinariRight($id,$bonus_t,$point_right,$user_referred)
    {
        if ($bonus_t != 0) {
            WalletComission::Create([
                'type' => 4,
                'user_id'=> $id,
                'amount' => $bonus_t,
                'buyer_id' => $user_referred->referred_id,
                'description' => "Puntos que se utilizaron para generar el bono {$point_right}"
            ]);
        }
    }
    /**
     * Realiza la resta de los puntos
     */
    private function subtractPoints($points_array, $binary_point_menor)
    {
        for($i = 0; $i < count($points_array); $i++) {
            if($points_array[$i]->left_points === 0) {
                $i = $i++; 
            } else {
                $points_array[$i]->left_points = $points_array[$i]->left_points - $binary_point_menor->right_points;
                
                if( $points_array[$i]->left_points < 0 ) $points_array[$i]->left_points = 0;
                
                $binary_point_menor->update();
                $points_array[$i]->update();
                Log::debug('HERE1 :'.$points_array[$i]->left_points);
                // Log::debug('HERE2 :'.$binary_point_menor);
                // Log::debug('HERE I:'.$i);
            }
        }
    }
}
