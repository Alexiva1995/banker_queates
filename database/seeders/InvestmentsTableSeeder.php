<?php

namespace Database\Seeders;

use App\Models\Investment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InvestmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayInvestments = [
            [
                'user_id' => 2,
                'order_id' => 1,
                'package_id' => 1,
                'payment_plataform' => 0,
                'invested' => 200,
                'gain' => 0,
                'type' => 1,
                'capital' => 0,
                'status' => 1,
                'pay_utility' => 0,
                'buyer_id' => 1,
                'created_at' => Carbon::create(2022, 8, 01, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 8, 01, 0, 0, 0 )
            ],
            [
                'user_id' => 2,
                'order_id' => 2,
                'package_id' => 6,
                'payment_plataform' => 0,
                'invested' => 90,
                'gain' => 0,
                'type' => 2,
                'capital' => 0,
                'status' => 1,
                'pay_utility' => 0,
                'buyer_id' => 1,
                'created_at' => Carbon::create(2022, 7, 01, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 7, 01, 0, 0, 0 )
            ],
            [
                'user_id' => 2,
                'order_id' => 3,
                'package_id' => 17,
                'payment_plataform' => 0,
                'invested' => 80,
                'gain' => 0,
                'type' => 3,
                'capital' => 0,
                'status' => 1,
                'pay_utility' => 0,
                'buyer_id' => 1,
                'created_at' => Carbon::create(2022, 6, 01, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 6, 01, 0, 0, 0 )
            ],
        ];

        foreach ($arrayInvestments as $investment){
            Investment::create($investment);
	    }
    }
}
