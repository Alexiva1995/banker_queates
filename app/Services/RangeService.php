<?php

namespace App\Services;

use App\Models\User;
use App\Models\Range;
use Illuminate\Support\Facades\Log;

/**
 * Class RangeService.
 */
class RangeService
{
    /**
     * Asigna el rango correspondiente a los usuarios.
     */
    public function setUserRanges()
    {
        // Traemos a todos los usuarios del sistema menos al admin
        $users = User::where('status', '1')->where('id', '!=', '1')->get();
        // No nos interesan los usuarios con rango max, asi que los obviamos
        $users = $users->where('range_id', '!=', 3);

        foreach ($users as $user) {
            $countReferrals = 0;
            foreach ($user->referidos as $referido) {
                foreach ($referido->investments as $investment) {
                    if ($investment->invested == 7000) {
                        if ($countReferrals > 3) {
                            // Se pregunta si la inversion de este referido esta dentro de los 60 dias
                            if ($investment->updated_at > now()->subDays(60)) {
                                $countReferrals++;
                                // Validación bono DOBLE DIAMANTE
                                if ($countReferrals == 7) {
                                    $user->range_id = 2;
                                }
                                // Validación bono TRIPLE DIAMANTE
                                if ($countReferrals == 14) {
                                    $user->range_id = 3;
                                }
                            }
                        // Se pregunta si la inversion de este referido esta dentro de los 30 dias
                        } else if ($investment->updated_at > now()->subDays(30)) {
                            $countReferrals++;
                            // Validación bono DIAMANTE
                            if ($countReferrals == 3) {
                                $user->range_id = 1;
                            }
                        }
                        $user->save();
                    }
                }
            }
        }
    }
}
