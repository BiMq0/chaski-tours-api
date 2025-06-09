<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
         Schema::create('sitio_categoria', function (Blueprint $table) {
            $table->enum('nombre_categoria', [
                'Histórico', 'Arqueológico', 'Colonial', 'Religioso', 'Cultural',
                'Patrimonial', 'Museo', 'Batalla', 'Hito', 'Arquitectónico',
                'Industrial', 'Natural_Histórico'
            ]);
            
            $table->unsignedBigInteger('id_sitio');

            $table->primary(['nombre_categoria', 'id_sitio']);

            $table->foreign('id_sitio')
                  ->references('id_sitio')
                  ->on('sitio')
                  ->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('sitiocategoria');
    }
};
