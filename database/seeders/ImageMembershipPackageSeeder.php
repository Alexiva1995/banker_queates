<?php

namespace Database\Seeders;

use App\Models\MembershipPackage;
use Illuminate\Database\Seeder;

class ImageMembershipPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $membershipPackages = MembershipPackage::all();
        // foreach ($membershipPackages as $membershipPackage) {
        //     switch ($membershipPackage->membership_types_id) {
        //         case 1:
        //             $membershipPackage->rentability = '8-15%';
        //             $membershipPackage->image = 'forex-lg-'. $membershipPackage->amount_per_month . '.png';
        //             $membershipPackage->dark_image = 'forex-drk-'. $membershipPackage->amount_per_month . '.png';
        //             $membershipPackage->update();
        //             break;
        //         case 2:
        //             $membershipPackage->rentability = '15-30%';
        //             $membershipPackage->image = 'indice-lg-'. $membershipPackage->amount_per_month . '.png';
        //             $membershipPackage->dark_image = 'indice-drk-'. $membershipPackage->amount_per_month . '.png';
        //             $membershipPackage->update();
        //             break;
        //         case 3:
        //             $membershipPackage->image = 'crypto-lg-'. $membershipPackage->amount_per_month . '.png';
        //             $membershipPackage->dark_image = 'crypto-blk-'. $membershipPackage->amount_per_month . '.png';
        //             $membershipPackage->update();
        //             break;
        //         default:
        //             # code...
        //             break;
        //     }
        // }
    }
}
