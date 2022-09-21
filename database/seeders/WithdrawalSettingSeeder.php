<?php

namespace Database\Seeders;

use App\Models\WithdrawalSetting;
use Illuminate\Database\Seeder;

class WithdrawalSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WithdrawalSetting::create([
            'day_start' => 1,
            'day_end' => 2,
            'time_start' => '10:00',
            'time_end' => '17:00',
            'percentage' => 5
        ]);
    }
}
