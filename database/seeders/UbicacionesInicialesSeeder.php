<?php
namespace Database\Seeders;
use App\Models\Ubicacion;
use Illuminate\Database\Seeder;

class UbicacionesInicialesSeeder extends Seeder
{
    public function run()
    {
        $ubicaciones = [
            [
                'departamento' => 'La Paz',
                'municipio' => 'La Paz',
                'zona' => 'Centro',
                'calle' => 'Calle Jaén',
                'latitud' => -16.49496,
                'longitud' => -68.13558
            ],
            [
                'departamento' => 'Santa Cruz',
                'municipio' => 'Santa Cruz de la Sierra',
                'zona' => 'Centro',
                'calle' => 'Plaza 24 de Septiembre',
                'latitud' => -17.78351,
                'longitud' => -63.18210
            ],
            [
                'departamento' => 'Potosí',
                'municipio' => 'Potosí',
                'zona' => 'Centro Histórico',
                'calle' => 'Calle Quijarro',
                'latitud' => -19.58918,
                'longitud' => -65.75333
            ],
           
            [
                'departamento' => 'Oruro',
                'municipio' => 'Oruro',
                'zona' => 'Centro',
                'calle' => 'Santuario del Socavón',
                'latitud' => -17.96472,
                'longitud' => -67.10604
            ],
            [
                'departamento' => 'Potosí',
                'municipio' => 'Potosí',
                'zona' => 'Cerro Rico',
                'calle' => 'Minas del Cerro Rico',
                'latitud' => -19.61745,
                'longitud' => -65.74526
            ],
            [
                'departamento' => 'Chuquisaca',
                'municipio' => 'Sucre',
                'zona' => 'Centro Histórico',
                'calle' => 'Plaza 25 de Mayo',
                'latitud' => -19.04756,
                'longitud' => -65.25974
            ],
            [
                'departamento' => 'La Paz',
                'municipio' => 'Tiwanaku',
                'zona' => 'Sitio Arqueológico',
                'calle' => 'Ruinas de Tiwanaku',
                'latitud' => -16.55477,
                'longitud' => -68.67344
            ],
            [
                'departamento' => 'Cochabamba',
                'municipio' => 'Cochabamba',
                'zona' => 'Centro',
                'calle' => 'Plaza 14 de Septiembre',
                'latitud' => -17.38950,
                'longitud' => -66.15680
            ],
            [
                'departamento' => 'Tarija',
                'municipio' => 'Tarija',
                'zona' => 'Centro',
                'calle' => 'Casa Dorada',
                'latitud' => -21.53270,
                'longitud' => -64.73130
            ],
            [
                'departamento' => 'Chuquisaca',
                'municipio' => 'Sucre',
                'zona' => 'Centro Histórico',
                'calle' => 'Casa de la Libertad',
                'latitud' => -19.04682,
                'longitud' => -65.25924
            ],
            [
                'departamento' => 'La Paz',
                'municipio' => 'Copacabana',
                'zona' => 'Centro',
                'calle' => 'Basílica Nuestra Señora de Copacabana',
                'latitud' => -16.16583,
                'longitud' => -69.08583
            ],
            [
                'departamento' => 'Santa Cruz',
                'municipio' => 'Samaipata',
                'zona' => 'El Fuerte',
                'calle' => 'Ruinas de El Fuerte',
                'latitud' => -18.17889,
                'longitud' => -63.82056
            ],
            [
                'departamento' => 'Pando',
                'municipio' => 'Cobija',
                'zona' => 'Centro',
                'calle' => 'Catedral de Cobija',
                'latitud' => -11.02536,
                'longitud' => -68.76915
            ],
            [
                'departamento' => 'Beni',
                'municipio' => 'Trinidad',
                'zona' => 'Centro',
                'calle' => 'Catedral de Trinidad',
                'latitud' => -14.83282,
                'longitud' => -64.90156
            ],
            [
                'departamento' => 'La Paz',
                'municipio' => 'Sorata',
                'zona' => 'Centro',
                'calle' => 'Plaza Principal de Sorata',
                'latitud' => -15.77333,
                'longitud' => -68.64333
            ]
        ];

        foreach ($ubicaciones as $ubicacion) {
            Ubicacion::firstOrCreate(
                ['latitud' => $ubicacion['latitud'], 'longitud' => $ubicacion['longitud']],
                $ubicacion
            );
        }
    }
}