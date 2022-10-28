<?php

namespace App\Services;

use App\Models\User;
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
        if ( $user->range_id === 1 ) 
        {
            $left_side = false;
            $right_side = false;
    
            foreach($user->binaryChildrens as $children) 
            {
                if($children->binary_side === 'L') $left_side = true;
    
                if($children->binary_side === 'R') $right_side = true;
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
                        if($children->binary_side === 'L') $left_side++;
                        
                        if($children->binary_side === 'R') $right_side++;
                    }
                }
            }

            if( $left_side >= 2 && $right_side >= 2 && $user->getTotalRangePoints() >= 75000 )
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
     * Para obtener este requiere: 2 Sapphire 1 en cada lado y 200.000 volumen puntos en su organización y 
     * Solo puede obtener 100,000 Puntos máximo de un equipo.
     */
    private function rubyRange(User $user)
    {
        // Solo se evalua si el usuario es apto para el rango 4 si tiene el rango null, 1, 2, o 3. Si tiene rango 4 o mayor avanza al siguiente directamente.
        if ( $user->range_id <= 3 || $user->range_id === null ) 
        {
            // Contadores para referidos o hijos con licencias sapphire
            $left_side = 0;
            $right_side = 0;

            foreach($user->binaryChildrens as $children) 
            {
                // Preguntamos si este hijo tiene rango
                if( $children->range_id !== null ) 
                {
                    // De tenerlo preguntamos si es Sapphire
                    if( $children->range_id >= 3) 
                    {
                        if($children->binary_side === 'L') $left_side++;
                        
                        if($children->binary_side === 'R') $right_side++;
                    }
                }
            }
            // Si tienen mas de 100k de puntos lo limitamos a 100k. Si es menor se deja el valor por defecto.
            $right_points = $user->getRightRangePoints() > 100000 ? 100000 : $user->getRightRangePoints();
            $left_points = $user->getLeftRangePoints() > 100000 ? 100000 : $user->getLeftRangePoints();

            if( $left_side >= 1 && $right_side >= 1 && $right_points == 100000 && $left_points == 100000 ) 
            {
                $user->update(['range_id' => 4]);
                $this->emeraldRange($user);
            }

        } else {
            $this->emeraldRange($user);
        }
    }
    /**
     * Verifica si el usuario es apto para el rango 5 - Emerald y lo asigna. 
     * Para obtener este  require 2 Ruby’s 1 de cada lado y 1,000,000 volumen puntos en su organización.
     * Solo puede obtener 500,000 Puntos máximo de un equipo
     */
    private function emeraldRange(User $user)
    {
        // Solo se evalua si el usuario es apto para el rango 5 si tiene el rango null, 1, 2, 3, o 4. Si tiene rango 5 o mayor avanza al siguiente directamente.
        if ( $user->range_id <= 4 || $user->range_id === null ) 
        {
            // Contadores para referidos o hijos con licencias Rubys
            $left_side = 0;
            $right_side = 0;

            foreach($user->binaryChildrens as $children) 
            {
                // Preguntamos si este hijo tiene rango
                if( $children->range_id !== null ) 
                {
                    // De tenerlo preguntamos si es Ruby
                    if( $children->range_id >= 4) 
                    {
                        if($children->binary_side === 'L') $left_side++;
                        
                        if($children->binary_side === 'R') $right_side++;
                    }
                }
            }

            // Si tienen mas de 500k de puntos lo limitamos a 100k. Si es menor se deja el valor por defecto.
            $right_points = $user->getRightRangePoints() > 500000 ? 500000 : $user->getRightRangePoints();
            $left_points = $user->getLeftRangePoints() > 500000 ? 500000 : $user->getLeftRangePoints();

            if( $left_side >= 1 && $right_side >= 1 && $right_points == 500000 && $left_points == 500000 ) 
            {
                $user->update(['range_id' => 5]);
                $this->diamondRange($user);
            }

        } else {
            $this->diamondRange($user);
        }
    }
    /**
     * Verifica si el usuario es apto para el rango 6 - Diamond y lo asigna. 
     * Para obtener este requiere 3 Emerald maximo 2 de un lado y
     * 2,500,000 volumen puntos en su organización. Solo puede obtener 1.250.000 Puntos máximo de un equipo.
     */
    private function diamondRange(User $user)
    {
        // Contadores para referidos o hijos con licencias Emerald
        $left_side = 0;
        $right_side = 0;

        foreach($user->binaryChildrens as $children) 
        {
            // Preguntamos si este hijo tiene rango
            if( $children->range_id !== null ) 
            {
                // De tenerlo preguntamos si es Emerald
                if( $children->range_id >= 5) 
                {
                    if($children->binary_side === 'L' && $left_side < 2 ) $left_side++;
                    
                    if($children->binary_side === 'R' && $right_side < 2) $right_side++;
                }
            }
        }

        $total = $left_side + $right_side;

        // Si tienen mas de 1.25m de puntos lo limitamos a 1.25m. Si es menor se deja el valor por defecto.
        $right_points = $user->getRightRangePoints() > 1250000 ? 1250000 : $user->getRightRangePoints();
        $left_points = $user->getLeftRangePoints() > 1250000 ? 1250000 : $user->getLeftRangePoints();

        if( $total >= 3 && $right_points == 1250000 && $left_points == 1250000 ) 
        {
            $user->update(['range_id' => 6]);
        }
    }
}
