<?php

namespace Database\Factories;

use App\Models\Visitante;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitante>
 */
class VisitanteFactory extends Factory
{
    protected $model = Visitante::class;

    public function definition()
    {
        return [
            // Generamos un código aleatorio único de visitante
            'cod_visitante' => 'VIS' . strtoupper(Str::random(6)),

            'tipo_visitante' => $this->faker->randomElement(['Turista', 'Institucion']),
            'Activo' => true, // o 1, según cómo lo manejes
        ];
    }

    public function turista()
    {
        return $this->state([
            'tipo_visitante' => 'Turista',
        ]);
    }

    public function institucion()
    {
        return $this->state([
            'tipo_visitante' => 'Institucion',
        ]);
    }
}
