<?php

namespace Database\Factories;

use App\Models\Institucion;
use App\Models\Visitante;
use App\Models\Nacionalidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Institucion>
 */
class InstitucionFactory extends Factory
{
    protected $model = Institucion::class;

    public function definition()
    {
        return [
            'cod_visitante' => Visitante::factory()->create(['tipo_visitante' => 'Institucion'])->cod_visitante,
            'nombre' => $this->faker->company,
            'correo_electronico' => $this->faker->unique()->companyEmail,
            'contrasenia' => 'institucion123',
            'nacionalidad' => Nacionalidad::inRandomOrder()->first()->nacionalidad,
            'telefono' => $this->faker->numerify('88888888'),
            'nombre_represent' => $this->faker->name,
            'ap_pat_represent' => $this->faker->lastName,
            'correo_electronico_represent' => $this->faker->unique()->safeEmail,
            'telefono_represent' => $this->faker->numerify('8888888'),
        ];
    }

    // Estado para instituciones educativas
    public function educativa()
    {
        return $this->state(function (array $attributes) {
            return [
                'nombre' => 'Universidad ' . $this->faker->city,
            ];
        });
    }
}
