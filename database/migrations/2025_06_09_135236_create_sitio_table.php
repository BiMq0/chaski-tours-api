<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('sitio', function (Blueprint $table) {
            $table->id('id_sitio'); 
            $table->string('nombre', 30);
            $table->text('desc_conceptual_sitio');
            $table->text('desc_historica_sitio');
            $table->double('costo_sitio', 10, 2);
            $table->unsignedBigInteger('id_ubicacion');
            $table->enum('temporada_recomendada', ['Primavera', 'Verano', 'Otoño', 'Invierno'])->nullable();
            $table->text('recomendacion_climatica')->nullable();
            $table->time('horario_apertura')->nullable();
            $table->time('horario_cierre')->nullable();
            $table->boolean('activo')->default(true);

            $table->timestamps();

            $table->foreign('id_ubicacion')
                  ->references('id_ubicacion')
                  ->on('ubicacion')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sitio');
    }
};
