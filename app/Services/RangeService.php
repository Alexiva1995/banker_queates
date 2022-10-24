<?php

namespace App\Services;

use App\Models\BinaryPoint;
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
        $users = User::where('status', '1')->with('referidos', 'range', 'binaryChildrens')->where('id', '!=', '1')->get();

        // No nos interesan los usuarios con rango max, asi que los obviamos
        $users = $users->where('range_id', '!=', 6);

        foreach ($users as $user) 
        {
            $this->consultantRange($user);
        }
    }
    /**
     * Verifica si el usuario es apto para el rango 1 - Consultant y lo asigna. 
     * Para obtener este rango el usuario debe tener un afiliado que 
     */
    private function consultantRange(User $user) 
    {
        // Si el usuario no tiene rango, inicia la validación desde el primero. De lo contrario se envia directo a evaluar desde el rango 2
        if ( $user->range === null ) 
        {
            foreach($user->referidos as $children) 
            {
                if($children->hasActiveLicense()) 
                {
                    $user->update(['range_id' => 1]);
                    // Como obtuvo el rango 1 se envia evaluar al rango 2 - Qualified Consultant
                    $this->qualifiedConsultantRange($user);
                    break;
                }
            }
        } else {
            $this->qualifiedConsultantRange($user);
        }
    }
    /**
     * Verifica si el usuario es apto para el rango 2 - Qualified Consultant y lo asigna. 
     * Para obtener este rango el usuario debe tener un referido por cada lado
     */
    private function qualifiedConsultantRange(User $user) 
    {
        // Solo se evalua si el usuario es apto para el rango 2 si tiene el rango 1. Si tiene rango 2 o mayor avanza al siguiente directamente.
        if ( $user->range->id === 1 ) 
        {
            $left_side = false;
            $right_side = false;
    
            foreach($user->binaryChildrens as $children) 
            {
                Log::debug($children);
                if($children->binary_side === 'L') {
                    $left_side = true;
                };
    
                if($children->binary_side === 'R') {
                    $right_side = true;
                }
            }
    
            if( $left_side && $right_side ) 
            {
                $user->update(['range_id' => 2]);
                $this->sapphireRange($user);
            }

        } else {
            $this->sapphireRange($user);
        }
    }
    /**
     * Verifica si el usuario es apto para el rango 3 - Sapphire y lo asigna. 
     * Para obtener este requiere: 2 Consultores calificados de cada lado y 75.000 volumen puntos en su organización
     */
    private function sapphireRange(User $user) 
    {

    }

}
