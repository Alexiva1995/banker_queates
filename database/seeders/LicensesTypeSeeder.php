<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicensesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'COLIBRI'],
            ['name' => 'ESCORPION'],
            ['name' => 'ANACONDA'],
            ['name' => 'PANTERA'],
            ['name' => 'TIBURON'],
        ];

        DB::table('licenses_types')->insert($types);
    }
}
