<?php

namespace Database\Seeders;

use App\Models\Orden_pamm;
use Illuminate\Database\Seeder;
class OrdenesPamm extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Orden_pamm ::create([
            'user_id'=>7,
            'monto'=>100,
            'status'=>'0',
            'fecha'=>'2022-03-08 15:52:21'
        ]);

         Orden_pamm ::create([
            'user_id'=>4,
            'monto'=>1000,
            'status'=>'0',
            'fecha'=>'2022-03-08 15:52:21'
        ]);

        Orden_pamm ::create([
            'user_id'=>1,
            'monto'=>300,
            'status'=>'0',
            'fecha'=>'2022-03-08 15:52:21'
        ]);
    }
}
