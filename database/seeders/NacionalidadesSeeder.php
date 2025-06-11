<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nacionalidad;
class NacionalidadesSeeder extends Seeder
{
    public function run()
    {
        $nacionalidades = [
            ['nacionalidad' => 'Bolivia', 'prefijo_telefonico' => '+591'],
            ['nacionalidad' => 'Argentina', 'prefijo_telefonico' => '+54'],
            ['nacionalidad' => 'Brasil', 'prefijo_telefonico' => '+55'],
            ['nacionalidad' => 'Perú', 'prefijo_telefonico' => '+51'],
            ['nacionalidad' => 'Chile', 'prefijo_telefonico' => '+56'],
            ['nacionalidad' => 'Colombia', 'prefijo_telefonico' => '+57'],
            ['nacionalidad' => 'Ecuador', 'prefijo_telefonico' => '+593'],
            ['nacionalidad' => 'Paraguay', 'prefijo_telefonico' => '+595'],
            ['nacionalidad' => 'Uruguay', 'prefijo_telefonico' => '+598'],
            ['nacionalidad' => 'Venezuela', 'prefijo_telefonico' => '+58'],
        ];

        foreach ($nacionalidades as $nacionalidad) {
            Nacionalidad::firstOrCreate(
                ['nacionalidad' => $nacionalidad['nacionalidad']],
                $nacionalidad
            );
        }
    }
}
