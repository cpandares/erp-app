<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $servicios = [
            [
                'name' => 'Servicio 1',
                'description' => 'Descripción del servicio 1',
                'price' => 100.00,
                'active' => true,
            ],
            [
                'name' => 'Servicio 2',
                'description' => 'Descripción del servicio 2',
                'price' => 200.00,
                'active' => true,
            ],
            [
                'name' => 'Servicio 3',
                'description' => 'Descripción del servicio 3',
                'price' => 300.00,
                'active' => true,
            ],
        ];
    }
}
