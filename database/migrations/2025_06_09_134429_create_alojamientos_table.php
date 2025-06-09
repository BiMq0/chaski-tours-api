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
        Schema::create('Alojamiento', function (Blueprint $table) {
            $table->id('id_alojamiento');
            $table->string('nombre_aloj', 25);
            $table->double('nro_estrellas');
            $table->integer('nro_habitaciones');
            $table->timestamps(); 
            $table->boolean('Activo')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Alojamiento');
    }
};
