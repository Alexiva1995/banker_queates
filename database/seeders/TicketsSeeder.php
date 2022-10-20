<?php

namespace Database\Seeders;

use App\Models\Tickets;
use App\Models\MessageTicket;
use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Tickets::create([
            'id' => '2',
            'user_id' => '2',
            'name' => null,
            'email' => null,
            'categories' => '0',
            'priority' => '0',
            'status' => '0',
            'issue' => 'Prueba user2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        MessageTicket::create([
            'id' => '2',
            'user_id' => '2',
            'id_admin' => '1',
            'id_ticket' => '2',
            'type' => '0',
            'message' => 'Prueba de mensaje de user2',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Tickets::create([
            'id' => '3',
            'user_id' => '3',
            'name' => null,
            'email' => null,
            'categories' => '1',
            'priority' => '1',
            'status' => '1',
            'issue' => 'Prueba user3',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        MessageTicket::create([
            'id' => '3',
            'user_id' => '3',
            'id_admin' => '1',
            'id_ticket' => '3',
            'type' => '0',
            'message' => 'Prueba de mensaje de user3',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Tickets::create([
            'id' => '5',
            'user_id' => '5',
            'name' => null,
            'email' => null,
            'categories' => '2',
            'priority' => '2',
            'status' => '0',
            'issue' => 'Prueba user5',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        MessageTicket::create([
            'id' => '5',
            'user_id' => '5',
            'id_admin' => '1',
            'id_ticket' => '5',
            'type' => '0',
            'message' => 'Prueba de mensaje de user5',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Tickets::create([
            'id' => '6',
            'user_id' => '6',
            'name' => null,
            'email' => null,
            'categories' => '3',
            'priority' => '0',
            'status' => '1',
            'issue' => 'Prueba user6',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        MessageTicket::create([
            'id' => '6',
            'user_id' => '6',
            'id_admin' => '1',
            'id_ticket' => '6',
            'type' => '0',
            'message' => 'Prueba de mensaje de user6',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Tickets::create([
            'id' => '7',
            'user_id' => '7',
            'name' => null,
            'email' => null,
            'categories' => '4',
            'priority' => '1',
            'status' => '0',
            'issue' => 'Prueba user7',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        MessageTicket::create([
            'id' => '7',
            'user_id' => '7',
            'id_admin' => '1',
            'id_ticket' => '7',
            'type' => '0',
            'message' => 'Prueba de mensaje de user7',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Tickets::create([
            'id' => '8',
            'user_id' => '8',
            'name' => null,
            'email' => null,
            'categories' => '0',
            'priority' => '2',
            'status' => '1',
            'issue' => 'Prueba user8',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        MessageTicket::create([
            'id' => '8',
            'user_id' => '8',
            'id_admin' => '1',
            'id_ticket' => '8',
            'type' => '0',
            'message' => 'Prueba de mensaje de user8',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Tickets::create([
            'id' => '9',
            'user_id' => '9',
            'name' => null,
            'email' => null,
            'categories' => '1',
            'priority' => '0',
            'status' => '0',
            'issue' => 'Prueba user9',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        MessageTicket::create([
            'id' => '9',
            'user_id' => '9',
            'id_admin' => '1',
            'id_ticket' => '9',
            'type' => '0',
            'message' => 'Prueba de mensaje de user9',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Tickets::create([
            'id' => '10',
            'user_id' => '10',
            'name' => null,
            'email' => null,
            'categories' => '2',
            'priority' => '1',
            'status' => '1',
            'issue' => 'Prueba user10',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        MessageTicket::create([
            'id' => '10',
            'user_id' =>  '10',
            'id_admin' => '1',
            'id_ticket' =>  '10',
            'type' => '0',
            'message' => 'Prueba de mensaje de user10',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Tickets::create([
            'id' => '11',
            'user_id' => '11',
            'name' => null,
            'email' => null,
            'categories' => '3',
            'priority' => '2',
            'status' => '0',
            'issue' => 'Prueba user11',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        MessageTicket::create([
            'id' => '11',
            'user_id' =>  '11',
            'id_admin' => '1',
            'id_ticket' =>  '11',
            'type' => '0',
            'message' => 'Prueba de mensaje de user11',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Tickets::create([
            'id' => '12',
            'user_id' => '12',
            'name' => null,
            'email' => null,
            'categories' => '4',
            'priority' => '0',
            'status' => '1',
            'issue' => 'Prueba user12',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        MessageTicket::create([
            'id' => '12',
            'user_id' =>  '12',
            'id_admin' => '1',
            'id_ticket' =>  '12',
            'type' => '0',
            'message' => 'Prueba de mensaje de user12',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Tickets::create([
            'id' => '13',
            'user_id' => '13',
            'name' => null,
            'email' => null,
            'categories' => '0',
            'priority' => '1',
            'status' => '0',
            'issue' => 'Prueba user13',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        MessageTicket::create([
            'id' => '13',
            'user_id' =>  '13',
            'id_admin' => '1',
            'id_ticket' =>  '13',
            'type' => '0',
            'message' => 'Prueba de mensaje de user13',
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
