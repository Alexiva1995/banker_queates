<?php

namespace App\Services;

use App\Models\Investment;
use App\Models\PointRange;
use App\Models\User;
/**
 * Class PointsService que se encarga de lo relacionado con la asignación de puntos.
 */
class PointsService
{
    /**
     * Genera los puntos de rango por compra de paquetes de manera recursiva.
     */
    public function assignPointsRangeRecursively(User $user, $amount, $order)
    {
        // Si la cantidad de puntos del paquete no es mayor a 0, se cancela la función
        if($amount <= 0) return;
        
        if($user->binary_id != 0 || !empty($user->binary_id))
        {
            $referred = $user->padre;
            //$user->points_pr += $amount;
            //$user->update();
            $menberpadre = Investment::where('user_id',$user->buyer_id)->where('status', '1')->first();

            if ($menberpadre != null) 
            {
                if($referred->status == 1){
                    $historial_point = new PointRange;
                    $historial_point->orden_id = $order->id;
                    $historial_point->status = 0;
                    $historial_point->user_id = $user->buyer_id;
                    $historial_point->buyer_id = $order->user_id;
                    $historial_point->quantity = $amount;
                    $historial_point->quantity_log = $amount;

                    $historial_point->save();
                }

                $this->assignPointsRangeRecursively($referred, $amount, $order);
            }
        }
    }
}
