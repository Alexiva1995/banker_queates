<?php

namespace Database\Seeders;

use App\Models\LicensePackage;
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
            [
                'name' => 'Consultant Binary Position',
                'amount' => 50,
                'description' => '$500',
                'image' => "Consultant.png",
                'commissions' => '0',
                'leadership_points' => 0,
                'binary_points' => 0,
                'level' => 0,
                'deposit_min' => 100,
                'deposit_max' => 500,
                'dark_image' => null,
                'emblem' => '1'
            ],
            [
                'name' => 'Standard License',
                'amount' => 150,
                'description' => '$1000',
                'image' => "Standar.png",
                'commissions' => '1',
                'leadership_points' => 75,
                'binary_points' => 75,
                'level' => 3,
                'deposit_min' => 500,
                'deposit_max' => 1000,
                'dark_image' => null,
                'emblem' => '2'
            ],
            [
                'name' => 'Gold License.',
                'amount' => 500,
                'description' => '$3000',
                'image' => "Golden.png",
                'commissions' => '1',
                'leadership_points' => 250,
                'binary_points' => 250,
                'level' => 4,
                'deposit_min' => 1001,
                'deposit_max' => 3000,
                'dark_image' => null,
                'emblem' => '3'
            ],
            [
                'name' => 'Titanium License',
                'amount' => 1000,
                'description' => '$$10,000',
                'image' => "Titanium.png",
                'commissions' => '1',
                'leadership_points' => 500,
                'binary_points' => 500,
                'level' => 5,
                'deposit_min' => 3001,
                'deposit_max' => 10000,
                'dark_image' => null,
                'emblem' => '4'
            ],
            [
                'name' => 'Platinum License',
                'amount' => 2000,
                'description' => '$50,000',
                'image' => "Platinium.png",
                'commissions' => '1',
                'leadership_points' => 1000,
                'binary_points' => 1000,
                'level' => 7,
                'deposit_min' => 10001,
                'deposit_max' => 50000,
                'dark_image' => null,
                'emblem' => '5'
            ],
            [
                'name' => 'Banker Platinum License',
                'amount' => 5000,
                'description' => "$100,000",
                'image' => 'Banker.png',
                'commissions' => '1',
                'leadership_points' => 2500,
                'binary_points' => 2500,
                'level' => 10,
                'deposit_min' => 10001,
                'deposit_max' => 100000,
                'dark_image' => null,
                'emblem' => '6'
            ],
        ];

        foreach($licenses as $license)
        {
            LicensePackage::create($license);
        }
    }
}
