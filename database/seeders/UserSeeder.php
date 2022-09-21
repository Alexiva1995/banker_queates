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
            'email' => 'admin@project7k.com',
            'username'=> 'administrador',
            'admin' => '1',
            'password' => Hash::make('12345678'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1'
        ]);

        //usuario normal

        User::create([
            'name'=> 'user',
            'last_name'=> Str::random(5),
            'email'=> 'user@project7k.com',
            'username'=> 'user1',
            'password' => Hash::make('123456789'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '1'
        ]);

        User::create([
            'name'=> 'user2',
            'last_name'=> Str::random(5),
            'email'=> 'user2@project7k.com',
            'username'=> 'user2',
            'password' => Hash::make('123456789'),
            'status' => '1',
            'buyer_id' => '2'
        ]);

        User::create([
            'name'=> 'user3',
            'last_name'=> Str::random(5),
            'email'=> 'user3@project7k.com',
            'username'=> 'user3',
            'password' => Hash::make('123456789'),
            'status' => '1',
            'buyer_id' => '2'
        ]);

        User::create([
            'name'=> 'SubAdmin',
            'last_name'=> Str::random(5),
            'email'=> 'subAdmin@project7k.com',
            'username'=> 'user4',
            'admin' => '2',
            'password' => Hash::make('12345678'),
            'email_verified_at' => '2022-03-08 15:52:21',
            'status' => '1',
            'buyer_id' => '2'
        ]);
    }
}
