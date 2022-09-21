<?php

namespace Database\Seeders;

use App\Models\Range;
use Illuminate\Database\Seeder;

class RangesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayRanges = [
            [
                "name"=>"DIAMANTE I"
            ],
            [
                "name"=>"DIAMANTE II"
            ],
            [
                "name"=>"DIAMANTE III"
            ],
        ];

        foreach ($arrayRanges as $range ) {
	        Range::create($range);
	    }
    }
}
