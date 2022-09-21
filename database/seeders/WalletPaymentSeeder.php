<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WalletPayment;

class WalletPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayWallets = [
            [
                'image' => 'bnb.jpeg',
                'type' => 'bnb',
                'wallet' => 'bnb10nshr377xtlm8err9qu3jffwk2xl8lzqarad7a'
            ],
            [
                'image' => 'btc.jpeg',
                'type' => 'btc',
                'wallet' => 'bc1quw62796pl44jwj3nqxzl9pfupm54ua08xggfpy'
            ],
            [
                'image' => 'trc20.jpeg',
                'type' => 'trc20',
                'wallet' => 'TBnjQsSse1g8KHDPFKCUbwn3x1ohfizish'
            ]

        ];

        foreach ($arrayWallets as $wallet ) {
	        WalletPayment::create($wallet);
	    }
    }
}
