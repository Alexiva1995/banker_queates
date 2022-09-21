<?php

namespace App\Services;

use App\Models\Upgrade;
use App\Models\Utility;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use stdClass;

/**
 * Class RentabilityService.
 */
class RentabilityService
{
    public function applyRentability()
    {
        try {
            $utilities =  Utility::where('status', '0')->where('last_utility', '1')->with('investment')->get();

            foreach ($utilities as $utility) {
                $dato = 1;
                $rentabilityPackage = $utility->investment->membershipPackage->rentability;
                $accumulatedPercentageCurrent = $utility->accumulated_percentage;
                $total = 0;
                $percentage = 0;
                $accumulatedPercentageCalculated = number_format(($rentabilityPackage + $utility->accumulated_percentage), 2);
                
                $lastUpgrade = Upgrade::where('investment_id', $utility->investment_id)->where('status_utility', 1)->orderBy('id')->first();
                $allUpgrades = Upgrade::where('investment_id', $utility->investment_id)->where('status_utility', 0)->get();


                if($utility->created_at->format('Y-m-d') == now()->format('Y-m-d') && $allUpgrades->count() == 0)
                {
                    break;
                }else{
                    $firstDay = 0;
                    $collection = new Collection();
                    // Rentabilidad diaria
                    $monthDays = intval(date('t'));
                    $dailyRentability = $rentabilityPackage / $monthDays;
                    
                    foreach ($allUpgrades as $key => $upgrade) 
                    {
                        $dato = intval($upgrade->created_at->addDays(2)->format('d'));
                        $dato2 = $dato - $firstDay;
                        $dato2 *= $dailyRentability;
                        $dato3  = $dato2;
                        $lastUpgrade2Days = $lastUpgrade->created_at->addDays(2);
                        if($key == 0){
                            if( $lastUpgrade2Days->format('m') != now()->format('m'))
                            {
                                $dato2 = (($dato2 * $lastUpgrade->membershipPackage->amount) / 100);
                                $firstDay = $dato;
                                $collection->push([$firstDay, $dato2, $dato3]);
                            } else {
                                $firstDay = intval($lastUpgrade2Days->format('d'));
                                $dato2 = $dato - $firstDay;
                                $dato2 *= $dailyRentability;
                                $dato3  = $dato2;
                                $dato2 = (($dato2 * $lastUpgrade->membershipPackage->amount) / 100);
                                $firstDay = $dato;
                                $collection->push([$firstDay, $dato2, $dato3]);
                            }  
                        }else{
                            $dato2 = (($dato2 * $allUpgrades[$key - 1]->membershipPackage->amount) / 100);
                            $firstDay = $dato;
                            $collection->push([$firstDay, $dato2, $dato3]);    
                        }
                        $upgrade->status_utility = 1;
                        $upgrade->save();
                    }
                    if($allUpgrades->last() !== null)
                    {
                        $dato = $monthDays - intval($allUpgrades[$allUpgrades->count() - 1]->created_at->addDays(2)->format('d'));
                    } 
                    $dato2 = ((($dailyRentability * $dato) * $utility->investment->membershipPackage->amount) / 100);
                    $dato3 = (($dailyRentability * $dato));
                    $collection->push([$dato, $dato2, $dato3]);
                    Log::info($collection . Carbon::now()->format('Y-m-d'));
                    foreach ($collection as $item) {
                        $total += $item[1];
                        $percentage += $item[2];
                    }
                    Log::info($total . Carbon::now()->format('Y-m-d'));
                    if ($utility->investment->type == 3) 
                    {
                        if ($accumulatedPercentageCalculated >= 400) 
                        {
                            $this->createUtility400($accumulatedPercentageCurrent, $utility, $total,  $rentabilityPackage);
                            break;
                        }
                    }else{
                        if ($accumulatedPercentageCalculated >= 200)
                        {
                            $this->createUtility200($accumulatedPercentageCurrent, $utility, $total,  $rentabilityPackage);
                            break;
                        }
                    }
                    $this->createNormalUtility($utility, $rentabilityPackage, $total, $allUpgrades, $percentage); 
                    if ($utility->created_at->format('Y-m-d') == now()->format('Y-m-d')){
                        $utility->delete();
                    }
                    $utility->update(['last_utility' => '0']);
                }
            }
        } catch (\Throwable $th) {
            Log::info($th . Carbon::now()->format('Y-m-d'));
        }
    }

    /**
     * Crea la utilidad sumando el % exacto para llegar al limite de 400
     */
    private function createUtility400($accumulatedPercentageCurrent, $utility, $total,  $rentabilityPackage)
    {
        $rentabilityLimit = 400 - $accumulatedPercentageCurrent; 
        Utility::create([
            'user_id' => $utility->user_id,
            'investment_id' => $utility->investment_id,
            'amount' => ((($rentabilityLimit * $total) / $rentabilityPackage)),
            'amount_available' => ((($rentabilityLimit * $total) / $rentabilityPackage)),
            'accumulated_percentage' => ($rentabilityLimit + $utility->accumulated_percentage),
            'status' => '1',
            'last_utility' => '1'
        ]); 
    }
    /**
     * Crea la utilidad sumando el % exacto para llegar al limite de 200
     */
    private function createUtility200($accumulatedPercentageCurrent, $utility, $total,  $rentabilityPackage)
    {
        $rentabilityLimit = 200 - $accumulatedPercentageCurrent; 
        Utility::create([
            'user_id' => $utility->user_id,
            'investment_id' => $utility->investment_id,
            'amount' => ((($rentabilityLimit * $total) / $rentabilityPackage)),
            'amount_available' => ((($rentabilityLimit * $total) / $rentabilityPackage)),
            'accumulated_percentage' => ($rentabilityLimit + $utility->accumulated_percentage),
            'status' => '1',
            'last_utility' => "1"  
        ]); 
    }
    /**
     * Crea la utilidad con su % correspondiente
     */
    private function createNormalUtility($utility, $rentabilityPackage, $total, $allUpgrades, $percentage)
    {
        if ($allUpgrades->count() == 0) {
            $total = ((($rentabilityPackage * $utility->investment->invested) / 100));
        }
        if ($utility->created_at->format('Y-m-d') != now()->format('Y-m-d')){
            $percentage = ($rentabilityPackage + $utility->accumulated_percentage);
        }
        Utility::create([
            'user_id' => $utility->user_id,
            'investment_id' => $utility->investment_id,
            'amount' => $total,
            'amount_available' => $total, 
            'accumulated_percentage' => $percentage, 
            'status' => '0',
            'last_utility' => '1'
        ]);
    }
}
