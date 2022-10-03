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
            [   
                'name' => 'Consultant Binary Position',
                'amount' => 50, 
                'rentability' => 0, 
                'image' => null, 
                'dark_image' => null
            ],
            [   
                'name' => 'Standard License',
                'amount' => 150, 
                'rentability' => 0, 
                'image' => null, 
                'dark_image' => null
            ],
            [   
                'name' => 'Gold License.',
                'amount' => 500, 
                'rentability' => 0, 
                'image' => null, 
                'dark_image' => null
            ],
            [   
                'name' => 'Titanium License',
                'amount' => 1000, 
                'rentability' => 0, 
                'image' => null, 
                'dark_image' => null
            ],
            [   
                'name' => 'Platinum License',
                'amount' => 2000, 
                'rentability' => 0, 
                'image' => null, 
                'dark_image' => null
            ],
            [   
                'name' => 'Banker Platinum License',
                'amount' => 5000, 
                'rentability' => 0, 
                'image' => null, 
                'dark_image' => null
            ],
        ];

        DB::table('licenses_packages')->insert($licenses);
    }
}
