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
        // No nos interesan los usuarios con rango max, asi que los obviamos
        $users = User::where('status', '1')
                        ->with('referidos')
                        ->with('range')
                        ->where('id', '!=', '1')
                        ->where('range_id', '!=', 6)
                        ->get();

        $usersWithOutRange = $users->where('range_id', null);

        $usersWithConsultantRange = $users->where('range_id', 1);

        foreach ($usersWithOutRange as $user) {
            $this->consultantRange($user);
        }


    }
    /**
     * Verifica si el usuario es apto para el rango 1 - Consultant y lo asigna. 
     * Para obtener este rango el usuario debe tener un afiliado que 
     */
    private function consultantRange(User $user) 
    {
        foreach($user->referidos as $children) 
        {
            if($children->hasActiveLicense()) {
                $user->update(['range_id' => 1]);
                break;
            };
        }
    }
    /**
     * Verifica si el usuario es apto para el rango 2 - Qualidied Consultant y lo asigna. 
     * Para obtener este rango el usuario debe tener un referido por cada lado
     */
    private function qualifiedConsultantRange(User $user) 
    {
        foreach($user->referidos as $children) 
        {
            if($children->hasActiveLicense()) {
                $user->update(['range_id' => 1]);
                break;
            };
        }
    }

}
