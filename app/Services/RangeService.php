<?php

namespace App\Services;

use App\Models\User;
/**
 * Class RangeService.
 */
class RangeService
{
    // Esta variable contiene los usuarios pertenecientes al arbol binario del usuario
    protected $array_childrens = [];
    // Esta variable es un array que contiene a todos los hijos del lado derecho del arbol binario del usuario
    protected $right_childrens = [];
    // Esta variable es un array que contiene a todos los gijos del lado izquierdo del adbol binario del usuario
    protected $left_childrens = [];
    /*
    *  Variable que sirve para definir en que variable se van a guardar el resutlado del recorrido para obtener el arbol
    *  0 - Todos, 1 - Lado derecho, 2 - Lado Izquierdo.
    */
    protected $case;

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
            // Seteamos a caso 0 para traer todos los hijos, tanto de izquierda como derecha.
            $this->case = 0;
            // Obtenemos la lista de referidos
            $this->getTreeUsers( $users_array = [], $level = 1, [$user->id] );

            /*
             - Seteamos a caso 1 para traer los hijos por el lado derecho del arbol
             - Obtenemos los id de los referidos directos del lado derecho en un array
             - Incluimos a estos usuarios en el array inicial del lado derecho
             - Obtenemos la lista de referidos por lado derecho la cual se concadenara con los direchos del lado derecho
            */
            $this->case = 1;
            $right_direct_childrens_array = $user->binaryChildrens->where('binary_side', 'R')->pluck('id')->toArray();
            $right_childrens = $user->binaryChildrens->whereIn('id', $right_direct_childrens_array)->toArray();
            $this->getTreeUsers( $right_childrens, $level = 2, $right_direct_childrens_array );

            /*
             - Seteamos a caso 2 para traer los hijos por el lado derecho del arbol
             - Obtenemos los id de los referidos directos del lado derecho en un array
             - Incluimos a estos usuarios en el array inicial del lado derecho
             - Obtenemos la lista de referidos por lado derecho la cual se concadenara con los direchos del lado derecho
            */
            $this->case = 2;
            $left_direct_childrens_array = $user->binaryChildrens->where('binary_side', 'L')->pluck('id')->toArray();
            $left_childrens = $user->binaryChildrens->whereIn('id', $left_direct_childrens_array)->toArray();
            $this->getTreeUsers( $left_childrens, $level = 2, $left_direct_childrens_array );

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
            foreach($this->array_childrens as $children) 
            {
                if( $children->hasActiveLicense() ) 
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

            // Recorremos la lista de usuarios del lado derecho y comprobamos
            foreach($this->right_childrens as $children) 
            {
                // Preguntamos si este hijo tiene rango
                if( $children['range_id'] !== null ) 
                {
                    // De tenerlo preguntamos si es Qualified Consultant
                    if( $children['range_id'] >= 2) 
                    {
                        $right_side++;
                    }
                }
            }

            // Recorremos la lista de usuarios del lado izquierdo y comprobamos
            foreach($this->left_childrens as $children) 
            {
                // Preguntamos si este hijo tiene rango
                if( $children['range_id'] !== null ) 
                {
                    // De tenerlo preguntamos si es Qualified Consultant
                    if( $children['range_id'] >= 2) 
                    {
                        $left_side++;
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

            // Recorremos la lista de usuarios del lado derecho y comprobamos
            foreach($this->right_childrens as $children) 
            {
                // Preguntamos si este hijo tiene rango
                if( $children['range_id'] !== null ) 
                {
                    // De tenerlo preguntamos si es Sapphire
                    if( $children['range_id'] >= 3) 
                    {
                        $right_side++;
                    }
                }
            }

            // Recorremos la lista de usuarios del lado izquierdo y comprobamos
            foreach($this->left_childrens as $children) 
            {
                // Preguntamos si este hijo tiene rango
                if( $children['range_id'] !== null ) 
                {
                    // De tenerlo preguntamos si es Sapphire
                    if( $children['range_id'] >= 3) 
                    {
                        $left_side++;
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
     * Para obtener este  require 2 Ruby’s, 1 de cada lado y 1,000,000 volumen puntos en su organización.
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

            // Recorremos la lista de usuarios del lado derecho y comprobamos
            foreach($this->right_childrens as $children) 
            {
                // Preguntamos si este hijo tiene rango
                if( $children['range_id'] !== null ) 
                {
                    // De tenerlo preguntamos si es Ruby o mayor
                    if( $children['range_id'] >= 4) 
                    {
                        $right_side++;
                    }
                }
            }

            // Recorremos la lista de usuarios del lado izquierdo y comprobamos
            foreach($this->left_childrens as $children) 
            {
                // Preguntamos si este hijo tiene rango
                if( $children['range_id'] !== null ) 
                {
                    // De tenerlo preguntamos si es Ruby o mayor
                    if( $children['range_id'] >= 4) 
                    {
                        $left_side++;
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

        // Recorremos la lista de usuarios del lado derecho y comprobamos
        foreach($this->right_childrens as $children) 
        {
            // Preguntamos si este hijo tiene rango
            if( $children['range_id'] !== null ) 
            {
                // De tenerlo preguntamos si es emerald
                if( $children['range_id'] >= 5 && $right_side < 2) 
                {
                    $right_side++;
                }
            }
        }

        // Recorremos la lista de usuarios del lado izquierdo y comprobamos
        foreach($this->left_childrens as $children) 
        {
            // Preguntamos si este hijo tiene rango
            if( $children['range_id'] !== null && $left_side < 2 ) 
            {
                // De tenerlo preguntamos si es emerald
                if( $children['range_id'] >= 5 && $left_side < 2) 
                {
                    $left_side++;
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
    /**
     * Recorre el arbol de referidos de un usuario hasta el nivel 4
     * @param Array $users - El array que retorna son los usuarios hasta el nivel descrito
     * @param Integer $nivel -  El nivel hasta el cual se desea hacer el recorrido
     * @param Array $users_ids - Contiene los ids de los usuarios para buscar sus hijos
     */
    public function getTreeUsers($users = [], $nivel, $users_ids = [])
    {
        // Obtenemos los referidos directos de todos los ids que recibimos en el array users_ids
        $usersLevel = User::whereIn('binary_id', $users_ids)->get();

        // Recorremos el array obtenido y pusheamos cada id en un nuevo array
        foreach ($usersLevel as $userLevel) 
        {
            array_push($users, $userLevel);            
        }

        $users_ids = [];

        foreach ($usersLevel as $userLevel) 
        {
            array_push($users_ids, $userLevel->id);          
        }
        
        // Evaluamos hasta 4 niveles de profundidad
        if( $nivel == 4 ) 
        {
            // Asignamos el resultado a la variable correspondiente y finalizamos el ciclo con el return.
            if($this->case == 0)
            {
                $this->array_childrens = $users;
            } else if($this->case == 1) 
            {
                $this->right_childrens = $users;
            } else if($this->case == 2) 
            {
                $this->left_childrens = $users;
            }
            return;
        }

        $this->getTreeUsers($users, $nivel + 1, $users_ids);
    }
}
