<?php

namespace Database\Seeders;

use App\Models\Alojamiento;
use App\Models\Habitacion;
use Illuminate\Database\Seeder;

class AlojamientoSeeder extends Seeder
{
    public function run()
    {
        // Tipos de alojamiento con características realistas
        $tiposAlojamiento = [
            [
                'nombre' => 'Hotel Plaza',
                'estrellas' => 5,
                'habitaciones' => 120,
                'activo' => true,
                'habitaciones_por_tipo' => [
                    'Individual' => 30,
                    'Doble' => 60,
                    'Suite' => 20,
                    'Familiar' => 10
                ]
            ],
            [
                'nombre' => 'Hostal Andino',
                'estrellas' => 3,
                'habitaciones' => 40,
                'activo' => true,
                'habitaciones_por_tipo' => [
                    'Individual' => 15,
                    'Doble' => 20,
                    'Familiar' => 5
                ]
            ],
            [
                'nombre' => 'Eco Lodge',
                'estrellas' => 4,
                'habitaciones' => 25,
                'activo' => true,
                'habitaciones_por_tipo' => [
                    'Doble' => 15,
                    'Suite' => 10
                ]
            ],
            [
                'nombre' => 'Resort Paradisíaco',
                'estrellas' => 5,
                'habitaciones' => 80,
                'activo' => true,
                'habitaciones_por_tipo' => [
                    'Doble' => 40,
                    'Suite' => 30,
                    'Familiar' => 10
                ]
            ]
        ];

        foreach ($tiposAlojamiento as $alojamientoData) {
            // Crear el alojamiento principal
            $alojamiento = Alojamiento::create([
                'nombre_aloj' => $alojamientoData['nombre'],
                'nro_estrellas' => $alojamientoData['estrellas'],
                'nro_habitaciones' => $alojamientoData['habitaciones'],
                'Activo' => $alojamientoData['activo']
            ]);

            // Crear las habitaciones para este alojamiento
            $numeroHabitacion = 1;
            foreach ($alojamientoData['habitaciones_por_tipo'] as $tipo => $cantidad) {
                for ($i = 0; $i < $cantidad; $i++) {
                    Habitacion::create([
                        'nro_habitacion' => $numeroHabitacion++,
                        'id_alojamiento' => $alojamiento->id_alojamiento,
                        'tipo_habitacion' => $tipo,
                        'capacidad' => $this->getCapacidadPorTipo($tipo),
                        'disponible' => true
                    ]);
                }
            }
        }

        
    }

    /**
     * Obtiene la capacidad según el tipo de habitación
     */
    private function getCapacidadPorTipo(string $tipo): int
    {
        return match($tipo) {
            'Individual' => 1,
            'Doble' => 2,
            'Suite' => 2, // Suite normalmente para 2 pero más espacio
            'Familiar' => 4,
            default => 1,
        };
    }
}