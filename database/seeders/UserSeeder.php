<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // usuario admin
        User::create([
            'name' => 'admin',
            'last_name' => Str::random(5),
            'email' => 'admin@takeprofits.com',
            'username'=> 'administrador',
            'admin' => '1',
            'password' => Hash::make('12345678'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'binary_id' => 0,
            'binary_side' => null
        ]);

        //usuario normal

        User::create([
            'name'=> 'user',
            'last_name'=> Str::random(5),
            'email'=> 'user@takeprofits.com',
            'username'=> 'user1',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '1'
        ]);

        User::create([
            'name'=> 'user2',
            'last_name'=> Str::random(5),
            'email'=> 'user2@takeprofits.com',
            'username'=> 'user2',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '2'
        ]);

        User::create([
            'name'=> 'user3',
            'last_name'=> Str::random(5),
            'email'=> 'user3@takeprofits.com',
            'username'=> 'user3',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '3'
        ]);

        User::create([
            'name'=> 'SubAdmin',
            'last_name'=> Str::random(5),
            'email'=> 'subAdmin@takeprofits.com',
            'username'=> 'user4',
            'admin' => '2',
            'password' => Hash::make('12345678'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '4'
        ]);

        User::create([
            'name'=> 'user5',
            'last_name'=> Str::random(5),
            'email'=> 'user5@takeprofits.com',
            'username'=> 'user5',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '5'
        ]);

        User::create([
            'name'=> 'user6',
            'last_name'=> Str::random(5),
            'email'=> 'user6@takeprofits.com',
            'username'=> 'user6',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '6'
        ]);

        User::create([
            'name'=> 'user7',
            'last_name'=> Str::random(5),
            'email'=> 'user7@takeprofits.com',
            'username'=> 'user7',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '7'
        ]);

        User::create([
            'name'=> 'user8',
            'last_name'=> Str::random(5),
            'email'=> 'user8@takeprofits.com',
            'username'=> 'user8',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '8'
        ]);

        User::create([
            'name'=> 'user9',
            'last_name'=> Str::random(5),
            'email'=> 'user9@takeprofits.com',
            'username'=> 'user9',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '9'
        ]);

        User::create([
            'name'=> 'user10',
            'last_name'=> Str::random(5),
            'email'=> 'user10@takeprofits.com',
            'username'=> 'user10',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '10'
        ]);

        User::create([
            'name'=> 'user11',
            'last_name'=> Str::random(5),
            'email'=> 'user11@takeprofits.com',
            'username'=> 'user11',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '11'
        ]);

        User::create([
            'name'=> 'user12',
            'last_name'=> Str::random(5),
            'email'=> 'user12@takeprofits.com',
            'username'=> 'user12',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '2'
        ]);

        User::create([
            'name'=> 'user13',
            'last_name'=> Str::random(5),
            'email'=> 'user13@takeprofits.com',
            'username'=> 'user13',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '2'
        ]);

        User::create([
            'name'=> 'user14',
            'last_name'=> Str::random(5),
            'email'=> 'user14@takeprofits.com',
            'username'=> 'user14',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '2'
        ]);

        User::create([
            'name'=> 'user15',
            'last_name'=> Str::random(5),
            'email'=> 'user15@takeprofits.com',
            'username'=> 'user15',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '2'
        ]);

        User::create([
            'name'=> 'user16',
            'last_name'=> Str::random(5),
            'email'=> 'user16@takeprofits.com',
            'username'=> 'user16',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '2'
        ]);

        User::create([
            'name'=> 'user17',
            'last_name'=> Str::random(5),
            'email'=> 'user17@takeprofits.com',
            'username'=> 'user17',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '2'
        ]);

        User::create([
            'name'=> 'user18',
            'last_name'=> Str::random(5),
            'email'=> 'user18@takeprofits.com',
            'username'=> 'user18',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '2'
        ]);

        User::create([
            'name'=> 'user19',
            'last_name'=> Str::random(5),
            'email'=> 'user19@takeprofits.com',
            'username'=> 'user19',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '2'
        ]);

        User::create([
            'name'=> 'user20',
            'last_name'=> Str::random(5),
            'email'=> 'user20@takeprofits.com',
            'username'=> 'user20',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '2'
        ]);
    }
}
