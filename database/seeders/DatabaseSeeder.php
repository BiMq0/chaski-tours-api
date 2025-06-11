<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            NacionalidadesSeeder::class,
            UbicacionesInicialesSeeder::class,
            TransportesInicialesSeeder::class,
            AlojamientoSeeder::class
        ]);

        // Luego los factories para datos de prueba
        \App\Models\Turista::factory()->count(20)->create();
        \App\Models\Institucion::factory()->count(5)->create();
       
    }
}
