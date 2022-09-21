<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UtilityLog;

class UtilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayUtilitylogs = [
            [
                "name"=>"Oro",
                "percentage"=>"17",
                "image" => "oro.png"
            ],
            [
                "name"=>"Plata",
                "percentage"=>"14.3",
                "image" => "plata.png"
            ],
            [
                "name"=>"Bronce",
                "percentage"=>"10",
                "image" => "bronce.png"
            ],
            [
                "name"=>"Platino",
                "percentage"=>"14.3",
                "image" => "platino.png"
            ],
        ];

        foreach ($arrayUtilitylogs as $utility ) {
	        UtilityLog::create($utility);
	    }
    }
 }
