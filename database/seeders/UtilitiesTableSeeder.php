<?php

namespace Database\Seeders;

use App\Models\Utility;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UtilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $arrayUtilities = [
            [
                'user_id' => 2, 
                'amount' => 2.5, 
                'status' => '0', 
                'utility_log' => 1,
                'investment_id' => 1, 
                'accumulated_percentage' => 5.4,
                'created_at' => Carbon::create(2022, 8, 03, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 8, 03, 0, 0, 0 )
            ],
            [
                'user_id' => 2, 
                'amount' => 23.57, 
                'status' => '1', 
                'utility_log' => 1,
                'investment_id' => 2, 
                'accumulated_percentage' => 15,
                'created_at' => Carbon::create(2022, 7, 04, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 7, 04, 0, 0, 0 )
            ],
            [
                'user_id' => 2, 
                'amount' => 74.15, 
                'status' => '2', 
                'utility_log' => 1,
                'investment_id' => 3, 
                'accumulated_percentage' => 54.25,
                'created_at' => Carbon::create(2022, 6, 05, 0, 0, 0 ),
                'updated_at' => Carbon::create(2022, 6, 05, 0, 0, 0 )
            ],
        ];

        foreach ($arrayUtilities as $utility ) {
	        Utility::create($utility);
	    }
    }
}
