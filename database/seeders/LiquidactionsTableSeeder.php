<?php

namespace Database\Seeders;

use App\Models\Liquidation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class LiquidactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayLiquidaction = [
            [
                'user_id' => 2, 
                'amount_gross' => 50,
                'amount_net' => 40, 
                'amount_fee' => 10,
                'hash' => '789456123',
                'wallet_used' => '123456789456123',
                'code_correo' => null,
                'fecha_code' => null,
                'type' => 0,
                'status' => 0, 
                'created_at' => Carbon::create(2022, 8, 03, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 8, 03, 0, 0, 0 )
            ],
            [
                'user_id' => 2, 
                'amount_gross' => 50,
                'amount_net' => 40, 
                'amount_fee' => 10,
                'hash' => '789456123',
                'wallet_used' => '123456789456123',
                'code_correo' => null,
                'fecha_code' => null,
                'type' => 1,
                'status' => 1, 
                'created_at' => Carbon::create(2022, 8, 03, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 8, 03, 0, 0, 0 )
            ],
            [
                'user_id' => 2, 
                'amount_gross' => 50,
                'amount_net' => 40, 
                'amount_fee' => 10,
                'hash' => '789456123',
                'wallet_used' => '123456789456123',
                'code_correo' => null,
                'fecha_code' => null,
                'type' => 2,
                'status' => 2, 
                'created_at' => Carbon::create(2022, 8, 03, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 8, 03, 0, 0, 0 )
            ],
        ];

        foreach ($arrayLiquidaction as $liquidaction ) {
	        Liquidation::create($liquidaction);
	    }
    }
}
