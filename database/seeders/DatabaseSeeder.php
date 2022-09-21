<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();

        $this->call(UserSeeder::class);
        $this->call(CountrieSeeder::class);
        $this->call(MembershipTypeSeeder::class);
        $this->call(MembershipPackageSeeder::class);
        $this->call(PrefixSeeder::class);
        $this->call(RangesSeeder::class);
        $this->call(ImageMembershipPackageSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(WalletPaymentSeeder::class);
        $this->call(WalletComissionSeeder::class);
        $this->call(InvestmentsTableSeeder::class);
        $this->call(UtilitiesTableSeeder::class);
        $this->call(UtilitySeeder::class);
        $this->call(WithdrawalSettingSeeder::class);
        $this->call(BonusSeeder::class);
        $this->call(LiquidactionsTableSeeder::class);
        $this->call(LevelsSeeder::class);
        //$this->call(PoolGlobalSeeder::class);

    }
}
