<?php

namespace App\Services;

use App\Models\Point;
use App\Models\User;

/**
 * Class PointsService que se encarga de lo relacionado con la asignación de puntos.
 */
class PointsService
{
    /**
     * Genera los puntos por compra de paquetes.
     */
    public function applyPoints(User $user, $amount, $level, $buyer_id, $orden)
    {
        $referred = $user->padre;
        if ($referred != null && $referred->id < $buyer_id && $amount > 0) {

            Point::create([
                'user_id' => $referred->id,
                'buyer_id' => $buyer_id,
                'orden_id' => $orden->id,
                'quantity' => $amount,
            ]);

            $level++;
            // //El nivel maximo es 15
            if ($level <= 20) 
            {
                $this->applyPoints($referred, $amount, $level, $buyer_id, $orden);
            }
        }
    }
}
