<?php

namespace Database\Factories;


use App\Models\Turista;
use App\Models\Visitante;
use App\Models\Nacionalidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Turista>
 */
class TuristaFactory extends Factory
{
    protected $model = Turista::class;

    public function definition()
    {
        return [
            'cod_visitante' => Visitante::factory()->create(['tipo_visitante' => 'Turista'])->cod_visitante,
            'correo_electronico' => $this->faker->unique()->safeEmail,
            'contrasenia' => 'password123', 
            'documento' => $this->faker->unique()->numerify('########'), 
            'nombre' => $this->faker->firstName,
            'ap_pat' => $this->faker->lastName,
            'ap_mat' => $this->faker->lastName,
            'fecha_nac' => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'nacionalidad' => Nacionalidad::inRandomOrder()->first()->nacionalidad,
            'telefono' => $this->faker->numerify('74488623'), 
        ];
    }

    // Estados personalizados
    public function boliviano()
    {
        return $this->state(function (array $attributes) {
            return [
                'nacionalidad' => 'Bolivia',
                'telefono' => $this->faker->numerify('74488623'),
            ];
        });
    }

    public function extranjero()
    {
        return $this->state(function (array $attributes) {
            return [
                'nacionalidad' => Nacionalidad::where('nacionalidad', '!=', 'Bolivia')
                    ->inRandomOrder()
                    ->first()
                    ->nacionalidad,
            ];
        });
    }
}
