<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('tours', function (Blueprint $table) {
            $table->id('id_tour');
            $table->string('nombre_tour', 30);
            $table->text('descripcion_tour')->nullable();
            $table->double('costo_tour', 10, 2);
            $table->unsignedBigInteger('id_sitio_inicio')->nullable();
            $table->unsignedBigInteger('id_sitio_fin')->nullable();
            $table->integer('duracion_dias');
            $table->integer('duracion_noches');
            $table->unsignedBigInteger('id_alojamiento')->nullable();
            $table->boolean('activo')->default(true);

            $table->timestamps();

            
            $table->foreign('id_sitio_inicio')
                  ->references('id_sitio')
                  ->on('sitio')
                  ->onDelete('set null');

            $table->foreign('id_sitio_fin')
                  ->references('id_sitio')
                  ->on('sitio')
                  ->onDelete('set null');

            $table->foreign('id_alojamiento')
                  ->references('id_alojamiento')
                  ->on('alojamiento')
                  ->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('tour');
    }
};
