<?php

namespace App\Services;

use App\Models\User;
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
     * Para obtener este rango el usuario debe tener un afiliado que tenga una licencia activa
     */
    private function consultantRange(User $user) 
    {
        // Si el usuario no tiene rango, inicia la validación desde el primero. De lo contrario se envia directo a evaluar desde el rango 2
        if ( $user->range_id === null ) 
        {
            foreach($user->referidos as $children) 
            {
                if($children->hasActiveLicense()) 
                {
                    $user->update(['range_id' => 1]);
                    Log::debug($user->range_id);
                    // Como obtuvo el rango 1 se envia evaluar al rango 2 - Qualified Consultant
                    $this->qualifiedConsultantRange($user);
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
        if ( $user->range_id === 1 ) 
        {
            $left_side = false;
            $right_side = false;
    
            foreach($user->binaryChildrens as $children) 
            {
                if($children->binary_side === 'L') {
                    $left_side = true;
                }
    
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
        // Solo se evalua si el usuario es apto para el rango 3 si tiene el rango null, 1 o 2. Si tiene rango 3 o mayor avanza al siguiente directamente.
        if ( $user->range_id <= 2 || $user->range_id === null ) 
        {
            $left_side = 0;
            $right_side = 0;
    
            foreach($user->binaryChildrens as $children) 
            {
                // Preguntamos si este hijo tiene rango
                if( $children->range_id !== null ) 
                {
                    // De tenerlo preguntamos si es Qualified Consultant
                    if( $children->range_id >= 2) 
                    {
                        Log::debug($children->binary_side);
                        if($children->binary_side === 'L') {
                            $left_side++;
                        }
                        
                        if($children->binary_side === 'R') {
                            $right_side++;
                        }
                    }
                }
            }
            Log::debug("Contador izquierdo {$left_side}");
            Log::debug("Contador derecho {$left_side}");
            if( $left_side >= 2 && $right_side >= 2 && $user->getTotalPoints() >= 75000 ) 
            {
                $user->update(['range_id' => 3]);
                $this->rubyRange($user);
            }

        } else {
            $this->rubyRange($user);
        }
    }
    /**
     * Verifica si el usuario es apto para el rango 4 - Ruby y lo asigna. 
     * Para obtener este requiere: 2 Sapphire en cada lado y 200.000 volumen puntos en su organización y 
     * Solo puede obtener 100,000 Puntos máximo de un equipo.
     */
    private function rubyRange(User $user)
    {

    }
}
