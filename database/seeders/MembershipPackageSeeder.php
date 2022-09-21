<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MembershipPackage;

class MembershipPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            //bronce
            ['amount' => 100, 'rentability' => 10, 'membership_types_id' => 1, 'image' => '100.png', 'dark_image' => '100.png'],
            ['amount' => 200, 'rentability' => 10, 'membership_types_id' => 1, 'image' => '200.png', 'dark_image' => '200.png'],
            ['amount' => 500, 'rentability' => 10, 'membership_types_id' => 1, 'image' => '500.png', 'dark_image' => '500.png'],
            ['amount' => 1000, 'rentability' => 10, 'membership_types_id' => 1, 'image' => '1000.png', 'dark_image' => '1000.png'],
            ['amount' => 3000, 'rentability' => 10, 'membership_types_id' => 1, 'image' => '3000.png', 'dark_image' => '3000.png'],
            //plata
            ['amount' => 5000, 'rentability' => 14.3, 'membership_types_id' => 2, 'image' => '5000.png', 'dark_image' => '5000.png'],
            ['amount' => 7000, 'rentability' => 14.3, 'membership_types_id' => 2, 'image' => '7000.png', 'dark_image' => '7000.png'],
            ['amount' => 10000, 'rentability' => 14.3, 'membership_types_id' => 2, 'image' => '10000.png', 'dark_image' => '10000.png'],
            ['amount' => 20000, 'rentability' => 14.3, 'membership_types_id' => 2, 'image' => '20000.png', 'dark_image' => '20000.png'],
            ['amount' => 30000, 'rentability' => 14.3, 'membership_types_id' => 2, 'image' => '30000.png', 'dark_image' => '30000.png'],
            ['amount' => 50000, 'rentability' => 14.3, 'membership_types_id' => 2, 'image' => '50000.png', 'dark_image' => '50000.png'],
            ['amount' => 100000, 'rentability' => 14.3, 'membership_types_id' => 2, 'image' => '100000.png', 'dark_image' => '100000.png'],        
            //oro
            ['amount' => 100, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '100.png', 'dark_image' => '100.png'],
            ['amount' => 200, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '200.png', 'dark_image' => '200.png'],
            ['amount' => 500, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '500.png', 'dark_image' => '500.png'],
            ['amount' => 1000, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '1000.png', 'dark_image' => '1000.png'],
            ['amount' => 3000, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '3000.png', 'dark_image' => '3000.png'],
            ['amount' => 5000, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '5000.png', 'dark_image' => '5000.png'],
            ['amount' => 7000, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '7000.png', 'dark_image' => '7000.png'],
            ['amount' => 10000, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '10000.png', 'dark_image' => '10000.png'],
            ['amount' => 20000, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '20000.png', 'dark_image' => '20000.png'],
            ['amount' => 30000, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '30000.png', 'dark_image' => '30000.png'],
            ['amount' => 50000, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '50000.png', 'dark_image' => '50000.png'],
            ['amount' => 100000, 'rentability' => 17, 'membership_types_id' => 3, 'image' => '100000.png', 'dark_image' => '100000.png'],        
            //platino
            ['amount' => 7000, 'rentability' => 14.3, 'membership_types_id' => 4, 'image' => '7000.png', 'dark_image' => '7000.png'],
            ['amount' => 10000, 'rentability' => 14.3, 'membership_types_id' => 4, 'image' => '10000.png', 'dark_image' => '10000.png'],
            ['amount' => 20000, 'rentability' => 14.3, 'membership_types_id' => 4, 'image' => '20000.png', 'dark_image' => '20000.png'],
            ['amount' => 30000, 'rentability' => 14.3, 'membership_types_id' => 4, 'image' => '30000.png', 'dark_image' => '30000.png'],
            ['amount' => 50000, 'rentability' => 14.3, 'membership_types_id' => 4, 'image' => '50000.png', 'dark_image' => '50000.png'],
            ['amount' => 100000, 'rentability' => 14.3, 'membership_types_id' => 4, 'image' => '100000.png', 'dark_image' => '100000.png'],        
        ];

        DB::table('membership_packages')->insert($packages);
    }
}
