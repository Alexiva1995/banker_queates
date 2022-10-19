<?php

namespace App\Services;

use App\Models\BinaryPoint;
use App\Models\Point;
use App\Models\PoolGlobal;
use App\Models\User;
use App\Models\Bonus;
use App\Models\Investment;
use App\Models\LicensePackage;
use App\Models\Order;
use App\Models\WalletComission;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\This;

/**
 * Class BonusService.
 */
class BonusService
{
    private $bonus;

    public function __construct(BonusService $bonus = null)
    {
        $this->bonus = $bonus;
    }
    //Aplica el building bonus y tambien aplica los puntos para evaluar el rango al final del ciclo trimestral
    public function BuildingBonus(User $user, $amount, $level, $buyer_id, $levelActive, $orden)
    {
        $referred = $user->padre;
        $bono = Bonus::where('type', '1')->where('level', $level)->first();
        if ($referred != null && $referred->id < $buyer_id) {
            // dd($bono);

            $wallet = WalletComission::create([
                'user_id' => $referred->id,
                'buyer_id' => $buyer_id,
                'investment_id' => $orden->investment->id,
                'order_id' => $orden->id,
                'description' => 'Bono inicio rapido',
                'type' => '0',
                'level' => $level,
                'status' => 0,
                'avaliable_withdraw' => 0
            ]);
            // $active_Affiliates = $this->CountActiveAffiliates($referred->id);

            if ($level == 1) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
                $wallet->amount_available = $gain;
            } elseif ($level == 2) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
                $wallet->amount_available = $gain;
            } elseif ($level == 3) {
                $gain = $amount *  $bono->percentage;
                $wallet->amount = $gain;
                $wallet->amount_available = $gain;
            } elseif ($level == 4) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
                $wallet->amount_available = $gain;
            } elseif ($level == 5) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
                $wallet->amount_available = $gain;
            } elseif ($level == 6) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
                $wallet->amount_available = $gain;
            } elseif ($level == 7) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
                $wallet->amount_available = $gain;
            } elseif ($level == 8) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
                $wallet->amount_available = $gain;
            } elseif ($level == 9) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
                $wallet->amount_available = $gain;
            } elseif ($level == 10) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
                $wallet->amount_available = $gain;
            }
            // elseif($level >= 8 && $level <= 9)
            // {
            //     $gain = $amount * 0.02;
            //     $wallet->amount = $gain;

            // }elseif($level >= 10 && $level <= 11)
            // {
            //     $gain = $amount * 0.01;
            //     $wallet->amount = $gain;

            // }elseif($level >= 12 && $level <= 15)
            // {
            //     $gain = $amount * 0.005;
            //     $wallet->amount = $gain;
            // }

            if ($wallet->amount == null) :
                $wallet->amount = 0;
            endif;


            $wallet->update();

            $level++;
            // //El nivel maximo es 15
            if ($level <= $levelActive->id) {
                // $this->BuildingBonus($referred, $amount, $level, $points, $buyer_id, $order);
                $this->BuildingBonus($referred, $amount, $level, $buyer_id, $levelActive, $orden);
            }
        }
    }
    //Cuenta la cantidad de afiliados directos activos
    private function CountActiveAffiliates($user_id)
    {
        return User::where('referred_id', $user_id)->where('status', '1')->count();
    }
    //Paga el bono por rango
    public function RangeBonus()
    {
        $users = User::where('status', '1')->get();
        $current_pool_global = PoolGlobal::where('active', 'yes')->first();
        $global_six_percent = $current_pool_global->amount;

        foreach ($users as $user) {
            $user_points = $this->getUserPoints($user);
            $user_deposit = $this->getUserDeposit($user, $current_pool_global);

            /*
            Paga el % segun el rango alcanzado
            MASTER UNIVERSAL 1.000.000 Puntos en red y deposito de 50.000 gana 3% del Pool global
            MASTER GLOBAL 500.000 Puntos en red y deposito de 20.000 2% del Pool global
            MASTER INTERNATIONAL 250.000 Puntos en red y deposito de 10.000 1% del Pool global
            */
            if ($user_points >= 1000000 && $user_deposit >= 50000) {
                $range = 'MASTER UNIVERSAL';
                //el 3% del 6% global
                $amount = $global_six_percent / 2;

                $this->createWalletByRange($user, $range, $amount, $current_pool_global);
            } elseif ($user_points >= 500000 && $user_deposit >= 20000) {
                $range = 'MASTER GLOBAL';
                //el 2% del 6% global
                $amount = $global_six_percent / 3;
                $this->createWalletByRange($user, $range, $amount, $current_pool_global);
            } elseif ($user_points >= 250000 && $user_deposit >= 10000) {
                $range = 'MASTER INTERNATIONAL';
                //el 1% del 6% global
                $amount = $global_six_percent / 6;
                $this->createWalletByRange($user, $range, $amount, $current_pool_global);
            }
        }
    }
    /*
    Crea un registro de pago en la tabla wallets 
    Dicha tabla guarda el registro de los bonos, no guarda wallets.
    */
    private function createWalletByRange($user, $range, $amount, $current_pool_global)
    {
        if ($user->referidos != null) {
            WalletComission::create([
                'user_id' => $user->id,
                'referred_id' => $user->referidos->id,
                'descripcion' => "Bono Rango {$range}",
                'amount'    =>  $amount,
                'pool_global_id' => $current_pool_global->id,
                'buyer_id' => null
            ]);
        }
    }

    //Obtiene los puntos de red del usuario
    public function getUserPoints(User $user)
    {
        $user_points = 0;
        //Obtiene los registros de la tabla points del usuario
        $user_points_records = $user->Points;
        foreach ($user_points_records as $record) {
            $user_points += $record->quantity;
        }
        return $user_points;
    }
    //Obtiene el total de deposito del usuario
    public function getUserDeposit(User $user, $current_pool_global)
    {
        $user_deposit = 0;
        foreach ($user->memberships as $membership) {
            if ($membership->pool_global_id == $current_pool_global->id) {
                $user_deposit += $membership->ordenes->membershipPackage->amount;
            }
        }
        return $user_deposit;
    }

    //bono Recompra
    public function ReCompraBonus(User $user, $amount, $level, $points, $buyer_id, $order)
    {
        $referred = $user->padre()->first();
        $bono = Bonus::where('type', '1')->where('level', $level)->first();
        if ($referred != null && $referred->id < $buyer_id && $referred->id != 1) {
            // dd($bono);

            $wallet = WalletComission::create([
                'user_id' => $referred->id,
                'buyer_id' => $buyer_id,
                'description' => 'Bono inicio rapido',
                'type' => '0',
                'level' => $level
            ]);

            Point::create([
                'user_id' => $referred->id,
                'orden_id' => $order->id,
                'referred_id' => $buyer_id,
                'quantity' => $points,
            ]);

            // $active_Affiliates = $this->CountActiveAffiliates($referred->id);

            if ($level == 1) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
            } elseif ($level == 2) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
            } elseif ($level == 3) {
                $gain = $amount *  $bono->percentage;
                $wallet->amount = $gain;
            } elseif ($level == 4) {
                $gain = $amount * $bono->percentage;
                $wallet->amount = $gain;
            }
            // elseif($level >= 8 && $level <= 9)
            // {
            //     $gain = $amount * 0.02;
            //     $wallet->amount = $gain;

            // }elseif($level >= 10 && $level <= 11)
            // {
            //     $gain = $amount * 0.01;
            //     $wallet->amount = $gain;

            // }elseif($level >= 12 && $level <= 15)
            // {
            //     $gain = $amount * 0.005;
            //     $wallet->amount = $gain;
            // }

            if ($wallet->amount == null) :
                $wallet->amount = 0;
            endif;


            $wallet->update();

            $level++;
            // //El nivel maximo es 15
            if ($level <= 4) {
                // $this->BuildingBonus($referred, $amount, $level, $points, $buyer_id, $order);
                $this->BuildingBonus($referred, $amount, $level, $points, $buyer_id, $order);
            }
        }
    }
    /**
    * Asigna los puntos binarios de manera recursiva 
    */ 
    public function assignPointsbinarioRecursively(User $user, $amount, $orden_id)
    {
        Log::debug('assignPointsbinarioRecursively');
        $binary = User::find($user->binary_id);
        $order = Investment::where('order_id', $orden_id)->first();
        $date = now();

        if ($user->binary_id != 0 || !empty($user->binary_id)) {
            
            
            $menberpadre = Investment::where('user_id', $user->binary_id)
                                    ->where('status', '1')
                                    ->where('package_id', '>=', 2)
                                    ->first();
            if ($user->binary_side == 'R') {
                dd('derecha');
                if (isset($order->id)) {
                    if ($menberpadre != null) {
                        BinaryPoint::updateOrCreate([
                            'investment_id' => $order->id,
                            'right_points_log' =>  $amount * 0.20,
                            'status' => 0,
                            'user_id' => $user->binary_id,
                            'buyer_id' => $order->user_id,
                            'right_points' => $amount * 0.20,
                            'limit_date' => $date->addMonth()
                        ]);
                    }
                }

                $this->assignPointsbinarioRecursively($binary, $amount, $orden_id);
            }

            if ($user->binary_side == 'L') {
                if (isset($order->id)) {
                    if ($menberpadre != null) {
                        BinaryPoint::updateOrCreate([
                            'investment_id' => $order->id,
                            'left_points_log' => $amount * 0.20,
                            'status' => 0,
                            'user_id' => $user->binary_id,
                            'buyer_id' => $order->user_id,
                            'left_points' => $amount * 0.20,
                            'limit_date' => $date->addMonth()
                        ]);
                    }
                }
                $this->assignPointsbinarioRecursively($binary, $amount, $orden_id);
            }
        }
    }

    /**
    * Elimina los puntos binarios si estan vencidos
    */
    public function deleteBinaryPoints()
    {
        $points = BinaryPoint::all();

        foreach($points as $point)
        {
            if($point->limit_date <= now()->format('Y-m-d')) 
            {
                Log::debug("Los puntos con id {$point->id} se han vencido ");
                $point->update(['left_points' => 0, 'right_points' => 0]);
            }
        }
    }
}
