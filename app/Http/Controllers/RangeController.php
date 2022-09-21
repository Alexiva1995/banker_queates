<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\PoolGlobal;
use App\Models\User;
use App\Services\BonusService;
use App\Services\RangeService;
use Illuminate\Http\Request;

class RangeController extends Controller
{
    public function __construct(RangeService $rangeService = null, BonusService $bonus = null)
    {
        $this->range = $rangeService;
        $this->bonus = $bonus;
    }
    
    public function setRangeToUsers()
    {
        $users = User::with('Points')->where('range_id', null)->get();
        $pool_global = PoolGlobal::where('active', 'yes')->first();
        foreach($users as $user)
        {
            $user_points = Point::where('user_id', $user->id)->where('pool_global_id', $pool_global->id)->sum('quantity'); 
            $user_deposit = 0; 
            foreach($user->memberships as $membership)
            {
                if($membership->pool_global_id == $pool_global->id)
                {
                    $user_deposit += $membership->ordenes->membershipPackage->amount;
                }
            }
        

            if( $user_points >= 1000000 && $user_deposit >= 50000 )
            {
                $user->update(['range_id' => 3]);

            }else if( $user_points >= 500000 && $user_deposit >= 20000 )
            {
                $user->update(['range_id' => 2]);

            }else if( $user_points >= 250000 && $user_deposit >= 10000 )
            {
                $user->update(['range_id' => 1]);
            }
        }
    }
}
