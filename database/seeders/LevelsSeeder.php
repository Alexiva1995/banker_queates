<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayLevels = [
            [
                'name' => 'Nivel 1',
                'status' => 1
            ],
            [
                'name' => 'Nivel 2',
                'status' => 1
            ],
            [
                'name' => 'Nivel 3',
                'status' => 1
            ],
            [
                'name' => 'Nivel 4',
                'status' => 1
            ],
            [
                'name' => 'Nivel 5',
                'status' => 0
            ],
        ];

        foreach ($arrayLevels as $level ) {
	        Level::create($level);
	    }
    }
}
