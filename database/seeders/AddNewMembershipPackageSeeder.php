<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipPackage;

class AddNewMembershipPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            ['amount' => 4000, 'amount_per_month' => 160, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 6000, 'amount_per_month' => 240, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 7000, 'amount_per_month' => 280, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 8000, 'amount_per_month' => 320, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 9000, 'amount_per_month' => 360, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 12000, 'amount_per_month' => 480, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 14000, 'amount_per_month' => 560, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 16000, 'amount_per_month' => 640, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 18000, 'amount_per_month' => 720, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 23000, 'amount_per_month' => 920, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 26000, 'amount_per_month' => 1040, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 29000, 'amount_per_month' => 1160, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 32000, 'amount_per_month' => 1280, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 36000, 'amount_per_month' => 1440, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 40000, 'amount_per_month' => 1600, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            ['amount' => 45000, 'amount_per_month' => 1800, 'percentage' => '8-15%', 'membership_types_id' => 1 ],
            
            ['amount' => 4000, 'amount_per_month' => 320,'percentage' => '15-30%', 'membership_types_id' => 2 ],
            ['amount' => 6000, 'amount_per_month' => 480,'percentage' => '15-30%', 'membership_types_id' => 2 ],
            ['amount' => 7000, 'amount_per_month' => 560,'percentage' => '15-30%', 'membership_types_id' => 2 ],
            ['amount' => 8000, 'amount_per_month' => 640,'percentage' => '15-30%', 'membership_types_id' => 2 ], 
            ['amount' => 9000, 'amount_per_month' => 720,'percentage' => '15-30%', 'membership_types_id' => 2 ],               
            ['amount' => 12000, 'amount_per_month' => 960,'percentage' => '15-30%', 'membership_types_id' => 2 ], 
            ['amount' => 14000, 'amount_per_month' => 1120,'percentage' => '15-30%', 'membership_types_id' => 2 ],           
            ['amount' => 16000, 'amount_per_month' => 1280,'percentage' => '15-30%', 'membership_types_id' => 2 ],
            ['amount' => 18000, 'amount_per_month' => 1440,'percentage' => '15-30%', 'membership_types_id' => 2 ],
            ['amount' => 23000, 'amount_per_month' => 1840,'percentage' => '15-30%', 'membership_types_id' => 2 ],
            ['amount' => 26000, 'amount_per_month' => 2080,'percentage' => '15-30%', 'membership_types_id' => 2 ],
            ['amount' => 29000, 'amount_per_month' => 2320,'percentage' => '15-30%', 'membership_types_id' => 2 ],            
            ['amount' => 32000, 'amount_per_month' => 2560,'percentage' => '15-30%', 'membership_types_id' => 2 ],
            ['amount' => 36000, 'amount_per_month' => 2880,'percentage' => '15-30%', 'membership_types_id' => 2 ],
            ['amount' => 40000, 'amount_per_month' => 3200,'percentage' => '15-30%', 'membership_types_id' => 2 ],
            ['amount' => 45000, 'amount_per_month' => 3600,'percentage' => '15-30%', 'membership_types_id' => 2 ]
        ];
        foreach ($packages as $package) {
            MembershipPackage::create([
                'amount' => $package['amount'],
                'amount_per_month' => $package['amount_per_month'],
                'percentage' => $package['percentage'],
                'membership_types_id' => $package['membership_types_id']
            ]);
        }
    }
}
