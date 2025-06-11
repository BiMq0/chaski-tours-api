<?php

// database/factories/HabitacionFactory.php

namespace Database\Factories;

use App\Models\Habitacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class HabitacionFactory extends Factory
{
    protected $model = Habitacion::class;

    public function definition()
    {
        $tipos = ['Individual', 'Doble', 'Suite', 'Familiar'];
        $tipo = $this->faker->randomElement($tipos);
        
        return [
            'nro_habitacion' => $this->faker->unique()->numberBetween(1, 500),
            'id_alojamiento' => \App\Models\Alojamiento::factory(),
            'tipo_habitacion' => $tipo,
            'capacidad' => $this->getCapacidad($tipo),
            'disponible' => $this->faker->boolean(85),
        ];
    }

    private function getCapacidad(string $tipo): int
    {
        return [
            'Individual' => 1,
            'Doble' => 2,
            'Suite' => 2,
            'Familiar' => 4,
        ][$tipo];
    }

    // Estados personalizados
    public function individual()
    {
        return $this->state(function (array $attributes) {
            return [
                'tipo_habitacion' => 'Individual',
                'capacidad' => 1,
            ];
        });
    }

    public function suite()
    {
        return $this->state(function (array $attributes) {
            return [
                'tipo_habitacion' => 'Suite',
                'capacidad' => 2,
            ];
        });
    }
}