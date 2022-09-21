<?php

namespace Database\Seeders;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayOrders = [
            [
                'user_id' => 2,
                'amount' => 200,
                'package_id' => 1,
                'fee' => 2,
                'voucher' => '111.jpg',
                'status' => 1,
                'type' => '0',
                'created_at' => Carbon::create(2022, 8, 01, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 8, 01, 0, 0, 0 )
            ],
            [
                'user_id' => 2,
                'amount' => 90,
                'voucher' => '111.jpg',
                'package_id' => 6,
                'fee' => 2,
                'status' => 1,
                'type' => '0',
                'created_at' => Carbon::create(2022, 7, 01, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 7, 01, 0, 0, 0 )
            ],
            [
                'user_id' => 2,
                'amount' => 80,
                'voucher' => '111.jpg',
                'package_id' => 17,
                'fee' => 2,
                'status' => 1,
                'type' => '0',
                'created_at' => Carbon::create(2022, 6, 01, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 6, 01, 0, 0, 0 )
            ],
        ];

        foreach ($arrayOrders as $order ) {
	        Order::create($order);
	    }
    }
}
