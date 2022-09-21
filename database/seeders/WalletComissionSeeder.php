<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletComissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wallets = [
            [
                'user_id' => 2,
                'buyer_id' => 3,
                'level' => 1,
                'description' => 'Bono de relleno',
                'investment_id' => null,
                'order_id' => '1',
                'amount' => 50.12,
                'amount_available' => 50.12,
                'amount_last_liquidation' => null,
                'type' => 0,
                'liquidation_id' => null,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'buyer_id' => 3,
                'level' => 1,
                'description' => 'Bono de relleno',
                'investment_id' => null,
                'order_id' => '1',
                'amount' => 3.15,
                'amount_available' => 3.15,
                'amount_last_liquidation' => null,
                'type' => 0,
                'liquidation_id' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'buyer_id' => 3,
                'level' => 1,
                'description' => 'Bono de relleno',
                'investment_id' => null,
                'order_id' => '2',
                'amount' => 7.00,
                'amount_available' => 7.00,
                'amount_last_liquidation' => null,
                'type' => 0,
                'liquidation_id' => null,
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'buyer_id' => 3,
                'level' => 1,
                'description' => 'Bono de Rango',
                'investment_id' => null,
                'order_id' => '2',
                'amount' => 13.13,
                'amount_available' => 13.13,
                'amount_last_liquidation' => null,
                'type' => 0,
                'liquidation_id' => null,
                'status' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'buyer_id' => 3,
                'level' => 1,
                'description' => 'Bono de relleno',
                'investment_id' => null,
                'order_id' => '2',
                'amount' => 50.12,
                'amount_available' => 50.12,
                'amount_last_liquidation' => null,
                'type' => 1,
                'liquidation_id' => null,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'buyer_id' => 3,
                'level' => 1,
                'description' => 'Bono de relleno',
                'investment_id' => null,
                'order_id' => '2',
                'amount' => 3.15,
                'amount_available' => 3.15,
                'amount_last_liquidation' => null,
                'type' => 1,
                'liquidation_id' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'buyer_id' => 3,
                'level' => 1,
                'description' => 'Bono de relleno',
                'investment_id' => null,
                'order_id' => '2',
                'amount' => 7.00,
                'amount_available' => 7.00,
                'amount_last_liquidation' => null,
                'type' => 1,
                'liquidation_id' => null,
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'buyer_id' => 3,
                'level' => 1,
                'description' => 'Bono de Rango',
                'investment_id' => null,
                'order_id' => '1',
                'amount' => 13.13,
                'amount_available' => 13.13,
                'amount_last_liquidation' => null,
                'type' => 1,
                'liquidation_id' => null,
                'status' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('wallets_commissions')->insert($wallets);
        
    }
}
