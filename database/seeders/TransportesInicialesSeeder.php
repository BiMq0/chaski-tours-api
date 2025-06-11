<?php
namespace Database\Seeders;
use App\Models\Transporte;
use Illuminate\Database\Seeder;

class TransportesInicialesSeeder extends Seeder
{
    public function run()
    {
        $transportes = [
            [
                'matricula' => 'ABC123',
                'marca' => 'Toyota',
                'modelo' => 'Hiace',
                'capacidad' => 12,
                'año' => 2020,
                'disponible' => true
            ],
            [
                'matricula' => 'DEF456',
                'marca' => 'Mercedes',
                'modelo' => 'Sprinter',
                'capacidad' => 16,
                'año' => 2021,
                'disponible' => true
            ],
            [
                'matricula' => 'GHI789',
                'marca' => 'Ford',
                'modelo' => 'Transit',
                'capacidad' => 8,
                'año' => 2019,
                'disponible' => false
            ]
        ];

        foreach ($transportes as $transporte) {
            Transporte::firstOrCreate(
                ['matricula' => $transporte['matricula']],
                $transporte
            );
        }
    }
}