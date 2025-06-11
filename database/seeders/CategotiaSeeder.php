<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sitio_Categoria;
class CategotiaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            'Histórico',
            'Arqueológico',
            'Colonial',
            'Religioso',
            'Cultural',
            'Patrimonial',
            'Museo',
            'Batalla',
            'Hito',
            'Arquitectónico',
            'Industrial',
            'Natural_Histórico'
        ];

        foreach ($categorias as $categoria) {
            Sitio_Categoria::firstOrCreate([
                'nombre_categoria' => $categoria
            ]);
        }
    }
}
