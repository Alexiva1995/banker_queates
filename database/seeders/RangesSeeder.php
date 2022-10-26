<?php

namespace Database\Seeders;

use App\Models\Range;
use Illuminate\Database\Seeder;

class RangesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayRanges = [
            [
                "name" => "Consultant",
                'description' => 'Se obtiene cuando un afiliado compra 1 licencia'
            ],
            [
                "name" => "Qualified Consultant",
                'description' => 'Es un lider que tiene 1 referido de cada lado'
            ],
            [
                "name" => "Sapphire",
                'description' => 'Requiere: 2 Consultores calificados de cada lado y 75.000 volumen puntos en su organización'
            ],
            [
                "name" => "Ruby",
                'description' => 'Requiere: 2 Sapphires 1 en de cada lado / 200.000 volumen puntos en su organización. Solo puede obtener 100,000 Puntos máximo de un equipo'
            ],
            [
                "name" => "Emerald",
                'description' => 'Require 2 Rubys 1 de cada lado / 1.000.000 volumen puntos en su organización. Solo puede obtener 350,000 Puntos máximo de un equipo'
            ],
            [
                "name" => "Diamond",
                'description' => 'Require 3 Emerald, maximo 2 de un lado / 2,500,000 volumen puntos en su organización. Solo puede obtener 850,000 Puntos máximo de un equipo'
            ],
        ];

        foreach ($arrayRanges as $range ) {
	        Range::create($range);
	    }
    }
}
