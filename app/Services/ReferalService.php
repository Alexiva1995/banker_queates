<?php

namespace App\Services;

use App\CustomClass\Referal;
use App\CustomClass\UserPoints;
use App\Models\Point;
use App\Models\PoolGlobal;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ReferalService.
 */
class ReferalService
{
    //Obtiene el top 10 directos referidos
    public function top10Referals()
    {
        $usersReferals = User::where('referred_id', '!=', null)->where('status','=','1')->get();
        $all_referals = new Collection();
        //Crea una coleccion la cual contiene en cada elemento una instancia de referal: el usuario y su cantidad de referidos directos activos
        foreach($usersReferals as $user_referal)
        {
            $referal = new Referal;
            $referal->user = $user_referal;
            $referal->referals = User::where('referred_id', $user_referal->id)->where('status', '1')->count();
            $all_referals->push($referal);
        }
        //ordena de mayor a menor segun cantidad de referidos activos
        $all_referals = $all_referals->sortByDesc('referals');
        $top10 = [];
        $i = 0;
        /*
        En cada iteración inserta el elemento al array $top10.
        El liminte es 10 iteraciones, al alcanzar esta cantidad se detiene el ciclo 
        */
        foreach($all_referals as $top)
        {
            if($i == 10) { break; }
            $top10[] = $top;
            $i++;
        }

        return $top10;
    }

    //Obtiene el top 10 con mas puntos en red
    public function top10RedPoints()
    {
        $users = User::where('referred_id', '!=', null)->where('status','=','1')->get();
        $all_users_points = new Collection();
        $pool_global = PoolGlobal::where('active', 'yes')->first();

        //Crea una coleccion la cual contiene en cada elemento una instancia de UserPoints: el usuario y su cantidad de puntos
        foreach($users as $user)
        {
            $user_points = new UserPoints;
            $user_points->user = $user;
            $user_points->points = Point::where('user_id', $user->id)->where('pool_global_id', $pool_global->id)->sum('quantity');
            $all_users_points->push($user_points);
        }
        $all_users_points = $all_users_points->sortByDesc('points');
        $top10 = [];
        $i = 0;

        /*
        En cada iteración inserta el elemento al array $top10.
        El liminte es 10 iteraciones, al alcanzar esta cantidad se detiene el ciclo 
        */
        foreach($all_users_points as $top)
        {
            if($i == 10) { break; }
            $top10[] = $top;
            $i++;
        }
        return $top10;

    }
}
