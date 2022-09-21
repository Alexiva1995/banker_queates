<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Bronce'],
            ['name' => 'Plata'],
            ['name' => 'Oro'],
            ['name' => 'Platino'],
        ];

        DB::table('membership_types')->insert($types);
    }
}
