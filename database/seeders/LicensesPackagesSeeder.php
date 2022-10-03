<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicensesPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $licenses = [
            ['amount' => 100, 'rentability' => 10, 'license_type_id' => 1, 'image' => '100.png', 'dark_image' => '100.png'],
            ['amount' => 100, 'rentability' => 10, 'license_type_id' => 1, 'image' => '100.png', 'dark_image' => '100.png'],
            ['amount' => 100, 'rentability' => 10, 'license_type_id' => 1, 'image' => '100.png', 'dark_image' => '100.png'],
            ['amount' => 100, 'rentability' => 10, 'license_type_id' => 1, 'image' => '100.png', 'dark_image' => '100.png'],
            ['amount' => 100, 'rentability' => 10, 'license_type_id' => 1, 'image' => '100.png', 'dark_image' => '100.png'],
            ['amount' => 100, 'rentability' => 10, 'license_type_id' => 1, 'image' => '100.png', 'dark_image' => '100.png'],
        ];

        DB::table('licenses_packages')->insert($licenses);
    }
}
