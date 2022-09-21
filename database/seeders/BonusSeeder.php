<?php

namespace Database\Seeders;

use App\Models\Bonus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayBonus = [
            [
                'percentage' => 0.08,
                'level' => 1,
                'type'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.02,
                'level' => 2,
                'type'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 3,
                'type'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 4,
                'type'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 5,
                'type'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 6,
                'type'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 7,
                'type'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 8,
                'type'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 9,
                'type'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 10,
                'type'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.08,
                'level' => 1,
                'type'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.02,
                'level' => 2,
                'type'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 3,
                'type'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 4,
                'type'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 5,
                'type'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 6,
                'type'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 7,
                'type'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 8,
                'type'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 9,
                'type'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'percentage' => 0.01,
                'level' => 10,
                'type'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($arrayBonus as $bono ) {
            Bonus::create($bono);
        }
    }
}
